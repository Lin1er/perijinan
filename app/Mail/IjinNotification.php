<?php

namespace App\Mail;

use App\Models\Ijin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class IjinNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ijin;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Ijin $ijin
     */
    public function __construct(Ijin $ijin)
    {
        $this->ijin = $ijin;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate PDF with ijin details
        $pdf = Pdf::loadView('pdfs.ijin_pdf', ['ijin' => $this->ijin]);

        return $this->subject('Ijin Notification')
                    ->view('emails.ijin_notification') // Set view untuk email
                    ->attachData($pdf->output(), 'ijin-details.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
