<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluhanMasyarakat;
use App\Models\User;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailKeluhan;

class KeluhanMasyarakatController extends Controller
{
    public function index()
    {
        $title = "Keluhan Masyarakat";
        $users = User::paginate(5);
        return view('user.keluhan-masyarakat', compact('title', 'users'));
    }
    public function kirimKeluhan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'keluhan' => 'required|string',
        ]);

        $data['action'] = 'sedang di proses';

        KeluhanMasyarakat::create($data);

        return redirect()->route('keluhan-masyarakat')->with('success', 'Keluhan telah disampaikan. Terima kasih!');
    }
    public function showDataKeluhan()
    {
        $title = "Data Keluhan Masyarakat";
        $keluhanMasyarakat = KeluhanMasyarakat::paginate(5);
        return view('feature.data-keluhan-masyarakat', compact('title', 'keluhanMasyarakat'));
    }
    public function terimaKeluhan($id)
    {
        $keluhan = KeluhanMasyarakat::find($id);

        if (!$keluhan) {
            return redirect()->route('data.keluhan')->with('error', 'Keluhan not found.');
        }

        $keluhan->action = 'done';
        $keluhan->save();

        $details = [
            'nama' => $keluhan->nama,
            'penerima' => $keluhan->email,
            'pesan' => $keluhan->keluhan,
        ];

        Mail::to($details['penerima'])->send(new EmailKeluhan($details));

        return redirect()->route('data.keluhan')->with('success', 'Keluhan marked as done and email sent.');
    }

    public function dataKeluhanUser()
    {
        $title = "Status Data Keluhan";
        $user = Auth::user();
        $dataKeluhanUser = KeluhanMasyarakat::where('id', $user->id)->paginate(5);

        return view('user.user-data-keluhan', compact('title', 'dataKeluhanUser'));
    }
    public function hapusKeluhan($id)
    {
        $keluhan = KeluhanMasyarakat::find($id);

        if (!$keluhan) {
            return redirect()->route('data.keluhan')->with('error', 'Keluhan not found.');
        }

        $keluhan->delete();

        return redirect()->route('data.keluhan')->with('success', 'Keluhan has been deleted.');
    }

}