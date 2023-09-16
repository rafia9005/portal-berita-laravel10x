<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class registerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;

    /**
     * Create a new message instance.
     *
     * @param  array  $userData
     * @return void
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Selamat Datang, ' . $this->userData['name'] . '! Registrasi Berhasil';

        return $this->view('email.registerMail')
            ->subject($subject)
            ->with([
                'name' => $this->userData['name'],
                'email' => $this->userData['email'],
            ]);
    }
}