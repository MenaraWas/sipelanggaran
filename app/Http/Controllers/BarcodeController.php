<?php
namespace App\Http\Controllers;

use App\Models\BarcodeHarian;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarcodeController extends Controller
{
    public function show(string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        // URL yang akan di-encode ke dalam QR
        $scanUrl = route('scan.proses', $token);

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($scanUrl);

        return view('barcode.show', compact('barcode', 'qrCode', 'scanUrl'));
    }
}