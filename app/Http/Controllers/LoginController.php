<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input username dan password
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Lakukan autentikasi tanpa opsi "remember me"
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman tujuan, misalnya dashboard
            return redirect()->intended('/')->with('success', 'Selamat datang '. Auth::user()->nama);
        }

        // Jika login gagal, flash message dan redirect kembali ke halaman login
        return redirect()->back()
            ->withInput($request->only('username')) // agar username terisi kembali
            ->with('fail', 'Username atau Password salah.');
    }

    /**
     * Melakukan logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session dan regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke homepage atau halaman login
        return redirect('/login')->with('success', 'Anda berhasil keluar');
    }
}
