<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login sebagai siswa, redirect ke home atau halaman sebelumnya
        if (Auth::guard('siswa')->check()) {
            return redirect()->intended('/');
        }

        return view('auth.siswa-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Sesuai janji: Intended redirect! (Kembali ke URL barcode yang tadi dicegat)
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Kombinasi email dan password tidak cocok.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
