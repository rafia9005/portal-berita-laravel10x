<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deviceName;
    public $loginTime;

    /**
     *
     * @param  string  $deviceName
     * @param  string  $loginTime
     * @return void
     */
    public function __construct($deviceName, $loginTime)
    {
        $this->deviceName = $deviceName;
        $this->loginTime = $loginTime;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->subject('Perangkat anda Login ke Layanan Masyarakat')->view('email.loginMail');
    }
}