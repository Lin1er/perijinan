<?php

namespace App\Jobs;

use App\Models\Ijin;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateSuratIjin
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $ijin;

    /**
     * Create a new job instance.
     */
    public function __construct(Ijin $ijin)
    {
        $this->ijin = $ijin;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $data = $this->ijin;

        // Generate PDF
        $pdf = Pdf::loadView('pdfs.ijin_pdf', ['ijin' => $this->ijin]);

        // Simpan PDF ke storage
        $filename = 'surat_ijin_' . $this->ijin->id . '.pdf';
        Storage::disk('public')->put('surat_ijin/' . $filename, $pdf->output());

        // Tambahkan path file ke model ijin (jika perlu)
        $this->ijin->update(['file_surat_ijin' => $filename]);
    }
}
