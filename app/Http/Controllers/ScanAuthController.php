<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanAuthController extends Controller
{
    /**
     * Tampilkan form input email sebelum scan.
     */
    public function showEmailForm(string $token)
    {
        // Sudah login → langsung ke konfirmasi
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('scan.konfirmasi', $token);
        }

        return view('scan.auth-email', compact('token'));
    }

    /**
     * Proses email: cek apakah sudah ada di DB.
     */
    public function prosesEmail(Request $request, string $token)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $email = strtolower(trim($request->email));
        $siswa = Siswa::where('email', $email)->first();

        if ($siswa) {
            // Email ditemukan → auto-login langsung
            Auth::guard('siswa')->login($siswa);
            $request->session()->regenerate();
            return redirect()->route('scan.konfirmasi', $token);
        }

        // Email belum ada → simpan di session, arahkan ke form register
        $request->session()->put('scan_auth_email', $email);
        return redirect()->route('scan.register', $token);
    }

    /**
     * Tampilkan form registrasi singkat untuk siswa baru.
     */
    public function showRegisterForm(Request $request, string $token)
    {
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('scan.konfirmasi', $token);
        }

        $email = $request->session()->get('scan_auth_email');

        // Jika tidak ada email di session, kembali ke form email
        if (!$email) {
            return redirect()->route('scan.auth', $token)
                ->withErrors(['email' => 'Sesi habis. Silakan masukkan email lagi.']);
        }

        return view('scan.auth-register', compact('token', 'email'));
    }

    /**
     * Proses registrasi siswa baru dari scan.
     */
    public function prosesRegister(Request $request, string $token)
    {
        $email = $request->session()->get('scan_auth_email');

        if (!$email) {
            return redirect()->route('scan.auth', $token);
        }

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'kelas' => ['required', 'string', 'max:10'],
            'jurusan' => ['required', 'string', 'max:50'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
        ]);

        // Cek sekali lagi apakah email sudah dipakai (race condition safeguard)
        if (Siswa::where('email', $email)->exists()) {
            $siswa = Siswa::where('email', $email)->first();
            Auth::guard('siswa')->login($siswa);
            $request->session()->forget('scan_auth_email');
            $request->session()->regenerate();
            return redirect()->route('scan.konfirmasi', $token);
        }

        // Buat akun baru dengan is_verified = false
        // NIS diisi sementara agar tidak error NOT NULL — admin update saat verifikasi
        $siswa = Siswa::create([
            'nis'         => 'REG-' . time(),
            'nama'        => $request->nama,
            'kelas'       => strtoupper($request->kelas),
            'jurusan'     => $request->jurusan,
            'email'       => $email,
            'is_verified' => false,
        ]);

        Auth::guard('siswa')->login($siswa);
        $request->session()->forget('scan_auth_email');
        $request->session()->regenerate();

        return redirect()->route('scan.konfirmasi', $token);
    }
}
