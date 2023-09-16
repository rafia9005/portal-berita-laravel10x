<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BantuanEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     *
     * @param array $data 
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.bantuanEmail')
            ->subject('Pengajuan Bantuan Telah Diterima');
    }
}