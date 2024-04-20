<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        // validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // coba username dan password
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            // beri session
            $request->session()->regenerate();

            // jika berhasil arahkan ke home
            return redirect()->route('home');
        }
        // jika gagal beri pesan salah
        return redirect()->back()->with('loginError', 'username / password salah');

    }

    public function logout(){
        // logout dan bersihkan session
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('login');
    }
}
