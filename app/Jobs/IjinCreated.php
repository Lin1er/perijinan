<?php

namespace App\Jobs;

use App\Models\Ijin;
use App\Models\User;
use App\Models\Whacenter;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IjinCreated
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ijin;

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
    public function handle(): void
    {
        try {
            $whacenter = Whacenter::where('default', 1)->firstOrFail();
            $deviceId = $whacenter->device_id;
            $phoneNumber = User::role('wakaAsrama')->first()->phoneNumber;
            $message = "Izin baru telah diajukan oleh " . $this->ijin->user->name . ", dengan keperluan: " . $this->ijin->reason . ". dari tanggal " . $this->ijin->date_start . " sampai dengan tanggal " . $this->ijin->date_end . ". Silahkan cek surat izin di website";

            $response = Http::post('https://app.whacenter.com/api/send', [
                'device_id' => $deviceId,
                'number' => $phoneNumber,
                'message' => $message,
                // 'file' => 'https://directly-liberal-buzzard.ngrok-free.app/storage/medic_attachments/N8JHaa3mZKlnoPBEBvLcmPrQiyWTdRH3EfBFkdis.jpg',
            ]);

            if ($response->failed()) {
                Log::error("Failed to send WhatsApp message: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("Error sending WhatsApp message: " . $e->getMessage());
        }
    }
}

