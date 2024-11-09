<?php

namespace App\Listeners;

use App\Events\IjinCreated;
use App\Mail\IjinNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        // Dapatkan semua admin
        // $admins = User::role('admin')->get(); // Menggunakan Spatie/Permission

        Mail::to('m.ulinasidiki@gmail.com')->send(new IjinNotification($ijin));

        // foreach ($admins as $admin) {
        //     Mail::to($admin->email)->send(new IjinNotification($ijin));
        // }
    }
}
