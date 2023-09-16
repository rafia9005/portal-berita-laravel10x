<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bantuan;
use Illuminate\Support\Facades\Mail;
use App\Mail\BantuanEmail;

class BantuanController extends Controller
{
    public function sendbantuan(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'nomor_hp' => 'required',
            'total_bantuan' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'tanggal_pengambilan' => 'required|date',
        ]);

        Bantuan::create([
            'email' => $validatedData['email'],
            'nomor_hp' => $validatedData['nomor_hp'],
            'total_bantuan' => $validatedData['total_bantuan'],
            'tanggal_pengambilan' => $validatedData['tanggal_pengambilan'],
        ]);

        Mail::to($request->email)->send(new BantuanEmail($validatedData));

        return redirect()->route('dashboard')->with('success', 'Bantuan telah berhasil diajukan.');
    }
}