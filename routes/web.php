<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\ScanAuthController;
use App\Http\Controllers\SiswaAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/barcode/{token}', [BarcodeController::class, 'show'])
    ->name('barcode.show')
    ->middleware('auth');

// Auth siswa (login lama — tetap ada untuk kompatibilitas)
Route::get('/login-siswa', [SiswaAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-siswa', [SiswaAuthController::class, 'login'])->name('siswa.login.post')->middleware('throttle:5,1');
Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

// Auth via Scan (email-based, tanpa password)
Route::get('/scan/{token}/auth',      [ScanAuthController::class, 'showEmailForm'])->name('scan.auth');
Route::post('/scan/{token}/auth',     [ScanAuthController::class, 'prosesEmail'])->name('scan.auth.proses');
Route::get('/scan/{token}/register',  [ScanAuthController::class, 'showRegisterForm'])->name('scan.register');
Route::post('/scan/{token}/register', [ScanAuthController::class, 'prosesRegister'])->name('scan.register.proses');

// Scan konfirmasi & proses (auth dihandle manual di controller)
Route::get('/scan/{token}',  [ScanController::class, 'konfirmasi'])->name('scan.konfirmasi');
Route::post('/scan/{token}', [ScanController::class, 'proses'])->name('scan.proses');