<?php

namespace App\Listeners;

use App\Events\IjinCreated;
use App\Mail\IjinNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class SendIjinNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(IjinCreated $event)
    {
        $ijin = $event->ijin;
        $phoneNumber = '081373793858';  // Ganti dengan nomor tujuan
        $message = "Izin baru telah diajukan oleh " . $ijin->user->name . " dengan alasan: " . $ijin->reason;

        // Contoh permintaan HTTP menggunakan dokumentasi API
        Http::post('https://app.whacenter.com/api/send', [
            'device_id' => '030b72451c45cfc63b984d6617147a98',
            'number' => $phoneNumber,
            'message' => $message,
        ]);
    }
}
