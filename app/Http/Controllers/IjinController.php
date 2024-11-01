<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        return view('ijin.create', compact('students'));
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
            'medic_attachment'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_pick' => 'required|date',
            'date_return' => 'required|date',
        ]);

        // Menyimpan file medic_attachment
        $medicAttachmentLink = null;
        if ($request->hasFile('medic_attachment')) {
            $file = $request->file('medic_attachment');
            $medicAttachmentLink = $file->store('medic_attachments', 'public'); // Simpan di folder `storage/app/public/attachments`
        }

        $ijin = new Ijin([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'class' => $request->class,
            'reason' => $request->reason,
            'medic_attachment_link' => $medicAttachmentLink, // Simpan link file bukti surat medis
            'date_pick' => $request->date_pick,
            'date_return' => $request->date_return,
            'verify_status' => '0',
            'status' => '0',

        ]);

        // dd($ijin);

        // Simpan data ke database
        $ijin->save();

        return redirect()->route('dashboard')->with('flash.banner', 'Data izin berhasil disimpan!')->with('flash.bannerStyle', 'success');
    }

    public function verify(Ijin $ijin , Request $request)
    {
        // Validasi tanggal pengembalian
        $request->validate([
            'date_return' => 'required|date',
        ]);

        // Ubah nilai verify_status menjadi 1 dan simpan tanggal pengembalian
        $ijin->verify_status = 1;
        $ijin->date_return = $request->input('date_return');  // Tanggal pengembalian yang disetujui

        // Simpan perubahan
        $ijin->save();

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Izin berhasil disetujui dengan tanggal pengembalian!');
    }


    // Metode untuk memproses pickup
    public function pickup(Request $request, $id)
    {
        $ijin = Ijin::findOrFail($id);

        // Memeriksa apakah ada data pickup_attachment_data
        if ($request->has('pickup_attachment_data')) {
            $imageData = $request->pickup_attachment_data;

            // Menghapus bagian 'data:image/png;base64,' dari string base64
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageName = 'pickup_' . Str::random(10) . '.png';

            // Simpan gambar ke storage
            Storage::disk('public')->put('attachments/' . $imageName, base64_decode($imageData));

            // Update model izin
            $ijin->pickup_attachment_link = 'attachments/' . $imageName;
            $ijin->status = 1; // Update status setelah pickup
            $ijin->save();
        }

        return redirect()->route('ijin.show', $ijin->id)->with('success', 'Bukti jemput berhasil disimpan.');
    }

    // Metode untuk memproses return
    public function return(Request $request, $id)
    {
        $ijin = Ijin::findOrFail($id);

        // Memeriksa apakah ada data return_attachment_data
        if ($request->has('return_attachment_data')) {
            $imageData = $request->return_attachment_data;

            // Menghapus bagian 'data:image/png;base64,' dari string base64
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageName = 'return_' . Str::random(10) . '.png';

            // Simpan gambar ke storage
            Storage::disk('public')->put('attachments/' . $imageName, base64_decode($imageData));

            // Update model izin
            $ijin->returned_at = now();
            $ijin->return_attachment_link = 'attachments/' . $imageName;
            $ijin->status = 2; // Update status setelah return
            $ijin->save();
        }

        return redirect()->route('ijin.show', $ijin->id)->with('success', 'Bukti pengembalian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ijin $ijin)
    {
        // Ambil data student terkait dengan izin ini
        $student = $ijin->student;

        // Kirim data izin dan student ke tampilan
        return view('ijin.show', compact('ijin', 'student'));
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
        // Hapus file lampiran jika ada
        if ($ijin->medic_attachment_link) {
            Storage::disk('public')->delete($ijin->medic_attachment_link);
        }

        if ($ijin->pickup_attachment_link) {
            Storage::disk('public')->delete($ijin->pickup_attachment_link);
        }

        if ($ijin->return_attachment_link) {
            Storage::disk('public')->delete($ijin->return_attachment_link);
        }

        // Hapus data izin dari database
        $ijin->delete();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Data izin berhasil dihapus!');
    }
}
