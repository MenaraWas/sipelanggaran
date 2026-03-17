<?php
namespace App\Http\Controllers;

use App\Models\AturanHukuman;
use App\Models\BarcodeHarian;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    // Halaman form scan (dipanggil setelah siswa scan QR)
    public function form(string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        if ($barcode->isExpired()) {
            return view('scan.expired');
        }

        return view('scan.form', compact('barcode'));
    }

    // Proses submit form scan
    public function proses(Request $request, string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        if ($barcode->isExpired()) {
            return redirect()->route('scan.form', $token);
        }

        $request->validate([
            'nis'   => 'required|exists:siswa,nis',
            'nilai' => 'nullable|integer|min:1',
        ]);

        $siswa = Siswa::where('nis', $request->nis)->firstOrFail();

        // Cek apakah siswa sudah scan barcode ini hari ini
        $sudahScan = PelanggaranSiswa::where('siswa_id', $siswa->id)
            ->where('barcode_id', $barcode->id)
            ->exists();

        if ($sudahScan) {
            return view('scan.sudah', compact('siswa', 'barcode'));
        }

        // Tentukan nilai aktual
        $nilai = $request->nilai ?? $barcode->nilai_default ?? 1;

        // Hitung nilai untuk akumulatif
        if ($barcode->jenisPelanggaran->is_akumulatif) {
            $totalSebelumnya = PelanggaranSiswa::where('siswa_id', $siswa->id)
                ->whereHas('barcode', fn($q) =>
                    $q->where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
                )
                ->sum('nilai');
            $nilai = $totalSebelumnya + $nilai;
        }

        // Cari aturan hukuman yang sesuai
        $aturan = AturanHukum::where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
            ->where('min_nilai', '<=', $nilai)
            ->where(fn($q) => $q->whereNull('max_nilai')->orWhere('max_nilai', '>=', $nilai))
            ->first();

        // Simpan pelanggaran
        $pelanggaran = PelanggaranSiswa::create([
            'siswa_id'   => $siswa->id,
            'barcode_id' => $barcode->id,
            'aturan_id'  => $aturan?->id,
            'nilai'      => $request->nilai ?? $barcode->nilai_default ?? 1,
            'scan_at'    => now(),
            'status'     => 'pending',
        ]);

        return view('scan.hasil', compact('siswa', 'barcode', 'pelanggaran', 'aturan'));
    }
}