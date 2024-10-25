<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IjinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Implementasi di sini jika perlu
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('create-ijin', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class' => 'required|string',
            'reason' => 'required|string',
            'attachment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_in' => 'required|date',
            'date_out' => 'required|date',
        ]);

        // Menyimpan file gambar
        $filePath = null; // Inisialisasi variabel untuk menyimpan link file
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public'); // Simpan di folder `storage/app/public/attachments`
        }

        $ijin = new Ijin([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'class' => $request->class,
            'reason' => $request->reason,
            'attachment_link' => $filePath, // Simpan link file
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'verify_status' => '0',
            'status' => '0',
        ]);

        // dd($ijin);

        // Simpan data ke database
        $ijin->save();

        return redirect()->route('dashboard')->with('success', 'Data izin berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ijin $ijin)
    {
        // Implementasi di sini jika perlu
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ijin $ijin)
    {
        // Implementasi di sini jika perlu
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ijin $ijin)
    {
        // Implementasi di sini jika perlu
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ijin $ijin)
    {
        // Implementasi di sini jika perlu
    }
}
