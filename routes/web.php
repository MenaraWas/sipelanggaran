<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barcode/{token}', [BarcodeController::class, 'show'])
    ->name('barcode.show');

use App\Http\Controllers\SiswaAuthController;

Route::get('/login-siswa', [SiswaAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-siswa', [SiswaAuthController::class, 'login'])->name('siswa.login.post');
Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])->name('siswa.logout');

Route::middleware('auth:siswa')->group(function () {
    Route::get('/scan/{token}', [ScanController::class, 'proses'])->name('scan.proses');
});