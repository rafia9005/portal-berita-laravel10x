<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class SendEmailController extends Controller
{
    public function index()
    {
        $title = "Send Email";
        return view('email.send', compact('title'));
    }
    public function sendEmail(Request $request)
    {
        $details = [
            'penerima' => $request->input('email'),
            'subject' => 'Subjek Email',
            'pesan' => 'Isi pesan email disini.',
        ];

        Mail::to($details['penerima'])->send(new Email($details));

        return redirect()->back()->with('message', 'Email telah dikirim.');
    }
}