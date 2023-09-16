<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        $title = "Register Panel";
        return view('auth.register', compact('title'));
    }
    public function showLoginForm()
    {
        $title = "Login Panel";
        return view('auth.login', compact('title'));
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $deviceName = $_SERVER['HTTP_USER_AGENT']; 
            $loginTime = now(); 

            $user = Auth::user(); 
            Mail::to($user->email)->send(new LoginMail($deviceName, $loginTime));

            return redirect()->intended('/dashboard');
        } else {
            return back()
                ->withInput()
                ->with('loginError', 'Email atau Password anda salah!');
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        Mail::to($user->email)->send(new registerMail($userData));

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}