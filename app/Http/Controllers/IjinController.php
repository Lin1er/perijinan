<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Jobs\IjinCreated as JobsIjinCreated;
use App\Jobs\IjinConfirmated as JobsIjinConfirmated;
use App\Jobs\StudentWentHome as JobsStudentWentHome;

class IjinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data izin, dengan relasi student
        $ijins = Ijin::with('student')->get();
        return view('ijin.index', compact('ijins'));
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
            'reason' => 'required|string',
            'medic_attachment'=> 'image|mimes:jpeg,png,jpg,gif',
            'date_pick' => 'required|date',
            'date_return' => 'required|date',
        ]);

        // Menyimpan file medic_attachment
        $attachments = [];
        if ($request->hasFile('medic_attachment')) {
            $attachments['medic'] = $request->file('medic_attachment')->store('medic_attachments', 'public');
        }
        
        
        $ijin = Ijin::create([
            'user_id' => Auth::id(),
            'student_id' => $request->student_id,
            'reason' => $request->reason,
            'date_pick' => $request->date_pick,
            'date_return' => $request->date_return,
            'status' => 'wait_approval',
            'attachments' => $attachments,
        ]);
        
        dispatch(new JobsIjinCreated($ijin));
        
        return back()->with('success', 'Data izin berhasil disimpan!');
    }

    /**
     * Update status dan catatan untuk verifikasi atau penolakan izin.
     */
    public function verify(Ijin $ijin, Request $request)
    {
        if($request->action == 'approve') {
            $request->validate([
                'notes' => 'required|string',
                'date_return' => 'required|date'
            ]);
        }
    
        // Tentukan status berdasarkan tombol yang ditekan (approve atau reject)
        $status = $request->action == 'approve' ? 'approved' : 'rejected';
    
        // Update status dan catatan
        $ijin->update([
            'status' => $status,
            'notes' => $request->notes
        ]);

        dispatch(new JobsIjinConfirmated($ijin));
    
        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Izin berhasil diperbarui!');
    }
    

    /**
     * Proses pickup
     */
    public function pickup(Request $request, Ijin $ijin)
    {
        if ($request->has('pickup_attachment_data')) {
            $imageData = $this->storeBase64Image($request->pickup_attachment_data, 'pickup');
            $ijin->attachments = array_merge($ijin->attachments ?? [], ['pickup' => $imageData]);
            $ijin->status = 'picked_up';
            $ijin->save();
        }

        dispatch(new JobsStudentWentHome($ijin));

        return redirect()->route('ijin.show', $ijin->id)->with('success', 'Bukti jemput berhasil disimpan.');
    }

    /**
     * Proses return
     */
    public function return(Request $request, Ijin $ijin)
    {
        if ($request->has('return_attachment_data')) {
            $imageData = $this->storeBase64Image($request->return_attachment_data, 'return');
            $ijin->attachments = array_merge($ijin->attachments ?? [], ['return' => $imageData]);
            $ijin->status = 'returned';
            $ijin->save();
        }

        return redirect()->route('ijin.show', $ijin->id)->with('success', 'Bukti pengembalian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ijin $ijin)
    {
        $student = $ijin->student;
        return view('ijin.show', compact('ijin', 'student'));
    }

    /**
     * Hapus izin dan file lampiran.
     */
    public function destroy(Ijin $ijin)
    {
        foreach ($ijin->attachments as $attachment) {
            Storage::disk('public')->delete($attachment);
        }
        
        $ijin->delete();
        return redirect()->route('dashboard')->with('success', 'Data izin berhasil dihapus!');
    }

    /**
     * Simpan gambar base64 dan kembalikan nama file.
     */
    private function storeBase64Image($base64Data, $prefix)
    {
        $imageData = str_replace('data:image/png;base64,', '', $base64Data);
        $imageData = str_replace(' ', '+', $imageData);
        $imageName = "{$prefix}_" . Str::random(10) . '.png';
        Storage::disk('public')->put("attachments/{$imageName}", base64_decode($imageData));
        
        return "attachments/{$imageName}";
    }
}
