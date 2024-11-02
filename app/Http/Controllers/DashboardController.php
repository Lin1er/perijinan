<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar untuk data izin
        $query = Ijin::query();

        // Filter pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('verify_status', $request->status);
        }

        // Urutkan data berdasarkan yang terbaru (misalnya berdasarkan kolom created_at)
        $query->orderBy('created_at', 'desc');

        // Ambil data dengan pagination
        $ijins = $query->paginate(10);

        return view('dashboard', compact('ijins'));
    }

}
