<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailKeluhan extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
        
        $this->subject('Keluhan Layanan Desa');
    }

    public function build()
    {
        return $this->view('email.mail')
            ->with('pesan', $this->details['pesan'])
            ->with('details', $this->details);
    }
}
