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
            'medic_attachment'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'return_attachment'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_pick' => 'required|date',
            'date_return' => 'required|date',
        ]);

        // Menyimpan file gambar
        $filePath = null; // Inisialisasi variabel untuk menyimpan link file
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public'); // Simpan di folder `storage/app/public/attachments`
        }
        // Menyimpan file medic_attachment
        $medicAttachmentLink = null;
        if ($request->hasFile('medic_attachment')) {
            $file = $request->file('medic_attachment');
            $medicAttachmentLink = $file->store('medic_attachments', 'public'); // Simpan di folder `storage/app/public/attachments`
        }

        // Menyimpan file return_attachment
        $returnAttachmentLink = null;
        if ($request->hasFile('return_attachment')) {
            $file = $request->file('return_attachment');
            $returnAttachmentLink = $file->store('return_attachments', 'public'); // Simpan di folder `storage/app/public/attachments`
        }

        $ijin = new Ijin([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'class' => $request->class,
            'reason' => $request->reason,
            'attachment_link' => $filePath, // Simpan link file bukti keluar
            'medic_attachment_link' => $medicAttachmentLink, // Simpan link file bukti surat medis
            'return_attachment_link' => $returnAttachmentLink, // Simpan link file bukti kembali
            'date_pick' => $request->date_pick,
            'date_return' => $request->date_return,
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
