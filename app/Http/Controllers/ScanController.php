<?php
namespace App\Http\Controllers;

use App\Models\AturanHukum;
use App\Models\BarcodeHarian;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function konfirmasi(string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        if ($barcode->isExpired()) {
            return view('scan.hasil', ['status' => 'error', 'message' => 'Barcode sudah kedaluwarsa.']);
        }

        $siswa = auth('siswa')->user();
        if (PelanggaranSiswa::where('siswa_id', $siswa->id)->where('barcode_id', $barcode->id)->exists()) {
            return view('scan.sudah', compact('siswa', 'barcode'));
        }

        return view('scan.konfirmasi', compact('siswa', 'barcode'));
    }

    public function proses(string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        if ($barcode->isExpired()) {
            return view('scan.hasil', ['status' => 'error', 'message' => 'Barcode sudah kedaluwarsa.']);
        }

        $siswa = auth('siswa')->user();
        if (PelanggaranSiswa::where('siswa_id', $siswa->id)->where('barcode_id', $barcode->id)->exists()) {
            return view('scan.sudah', compact('siswa', 'barcode'));
        }

        $jenis = $barcode->jenisPelanggaran;
        $nilaiIndikator = 1;

        if ($jenis->tipe_perhitungan === 'otomatis_waktu' && $jenis->jam_batas_masuk) {
            $waktuScan = now();
            $formatJamMasuk = date('H:i:s', strtotime($jenis->jam_batas_masuk));
            $jamBatas = \Carbon\Carbon::parse($waktuScan->format('Y-m-d') . ' ' . $formatJamMasuk);

            if ($waktuScan->greaterThan($jamBatas)) {
                $nilaiIndikator = $waktuScan->diffInMinutes($jamBatas);
            } else {
                return view('scan.hasil', [
                    'status' => 'error',
                    'message' => 'Belum masuk waktu pelanggaran (batas: ' . date('H:i', strtotime($jenis->jam_batas_masuk)) . ').'
                ]);
            }
        }

        $aturan = AturanHukum::where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
            ->where('min_nilai', '<=', $nilaiIndikator)
            ->where(fn($q) => $q->whereNull('max_nilai')->orWhere('max_nilai', '>=', $nilaiIndikator))
            ->first();

        if (!$aturan) {
            $aturan = AturanHukum::where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
                ->orderByDesc('max_nilai')
                ->first();
        }

        $pelanggaran = PelanggaranSiswa::create([
            'siswa_id' => $siswa->id,
            'barcode_id' => $barcode->id,
            'aturan_id' => $aturan?->id,
            'nilai' => $aturan ? $aturan->poin_pelanggaran : 0,
            'scan_at' => now(),
            'status' => 'pending',
        ]);

        return view('scan.hasil', [
            'status' => 'sukses',
            'siswa' => $siswa,
            'barcode' => $barcode,
            'pelanggaran' => $pelanggaran,
            'aturan' => $aturan
        ]);
    }
}