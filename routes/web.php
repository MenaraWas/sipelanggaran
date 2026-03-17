<?php

use App\Http\Controllers\BarcodeController;
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

Route::get('/scan/{token}', function ($token) {
    // TODO: Buat controller/view untuk halaman form scan
    return "Halaman scan pelanggaran untuk token: " . $token;
})->name('scan.form');