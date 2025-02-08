<?php

namespace App\Jobs;

use App\Models\Ijin;
use App\Models\Whacenter;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IjinConfirmated
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ijin;
    protected $action;

    /**
     * Create a new job instance.
     */
    public function __construct(Ijin $ijin, $action)
    {
        $this->ijin = $ijin;
        $this->action = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $whacenter = Whacenter::where('default', 1)->firstOrFail();
            $deviceId = $whacenter->device_id;
            $phoneNumber = $this->ijin->user->phoneNumber;
            $message = match ($this->action) {
                1 => "Pengajuan izin telah di setujui atas nama " . $this->ijin->student->name . " dengan keperluan: " . $this->ijin->reason . ". Di setujui dari tanggal " . date('d-m-Y', strtotime($this->ijin->date_pick)) . " sampai dengan tanggal " . date('d-m-Y', strtotime($this->ijin->date_return)) . ". dengan catatan: " . $this->ijin->notes . ". Silahkan cek surat izin di website, atau klik link di bawah ini: " . route('ijin.show', ['ijin' => $this->ijin->id]),
                0 => "Pengajuan izin telah di tolak atas nama " . $this->ijin->student->name . " dengan keperluan: " . $this->ijin->reason . ". Dikarenakan" . $this->ijin->notes,
                default => "Izin telah di proses atas nama " . $this->ijin->student->name . " dengan keperluan: " . $this->ijin->reason . ". Silahkan cek surat izin di website, atau klik link di bawah ini: " . route('ijin.show', ['ijin' => $this->ijin->id]),
            };

            $response = Http::timeout(60)->post('https://app.whacenter.com/api/send', [
                'device_id' => $deviceId,
                'number' => $phoneNumber,
                'message' => $message,
            ]);

            if ($response->failed()) {
                Log::error("Failed to send WhatsApp message: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Error sending WhatsApp message: " . $e->getMessage());
        }
    }
}
