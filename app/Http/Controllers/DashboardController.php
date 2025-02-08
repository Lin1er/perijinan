<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Ijin::query();

        if (auth()->user()->hasRole(['wakaAsrama', 'Super Admin'])) {
            // Tampilkan semua data ijin
        } elseif (auth()->user()->hasRole('satpam')) {
            $query->whereIn('status', ['approved', 'picked_up']);
        } else {
            $query->where('user_id', auth()->id());
        }

        // Filter pencarian jika ada
        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan data berdasarkan yang terbaru
        $query->orderBy('created_at', 'desc');

        // Ambil hasil query dengan pagination
        $ijins = $query->paginate(20);

        return view('dashboard', compact('ijins'));
    }
}

