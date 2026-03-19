<?php
namespace App\Http\Controllers;

use App\Models\AturanHukum;
use App\Models\BarcodeHarian;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function proses(string $token)
    {
        $barcode = BarcodeHarian::where('token', $token)
            ->with('jenisPelanggaran')
            ->firstOrFail();

        // Jika barcode expired, tampilkan view expired
        if ($barcode->isExpired()) {
            return view('scan.expired');
        }

        // Ambil data siswa dari session login
        $siswa = auth('siswa')->user();

        // Cek apakah siswa sudah scan barcode ini hari ini
        $sudahScan = PelanggaranSiswa::where('siswa_id', $siswa->id)
            ->where('barcode_id', $barcode->id)
            ->exists();

        if ($sudahScan) {
            return view('scan.sudah', compact('siswa', 'barcode'));
        }

        $jenis = $barcode->jenisPelanggaran;
        $nilaiIndikator = 1; // Default indikator/durasi

        if ($jenis->tipe_perhitungan === 'otomatis_waktu' && $jenis->jam_batas_masuk) {
            $waktuScan = now();

            // Format waktu menjadi Y-m-d H:i:s
            // Coba untuk memperbaiki jika input user memakai PM namun aslinya pagi
            $formatJamMasuk = date('H:i:s', strtotime($jenis->jam_batas_masuk));
            $jamBatas = \Carbon\Carbon::parse($waktuScan->format('Y-m-d') . ' ' . $formatJamMasuk);

            // Jika siswa scan lewat dari jam batas
            if ($waktuScan->greaterThan($jamBatas)) {
                $nilaiIndikator = $waktuScan->diffInMinutes($jamBatas);
            } else {
                // Di sistem 1-click scan, kita tidak bisa return back() dengan error input form form.
                // Kita harus mereject dengan layar pesan "Belum Waktunya" (bisa pinjam view expired atau bawaan).
                // Menggunakan redirect back ->with() dan menangkap di session aslinya dari login, 
                // tapi lebih aman throw error HTTP / view spesifik.
                // Untuk kesederhanaan, tampilkan view pesan.
                return response(view('scan.expired')->with('customMessage', 'Belum masuk waktu pelanggaran (batas: ' . date('H:i', strtotime($jenis->jam_batas_masuk)) . ').'));
            }
        }

        // Cari aturan hukuman yang sesuai dengan nilai indikator
        $aturan = AturanHukum::where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
            ->where('min_nilai', '<=', $nilaiIndikator)
            ->where(fn($q) => $q->whereNull('max_nilai')->orWhere('max_nilai', '>=', $nilaiIndikator))
            ->first();

        // Jika terlampau besar dari batas max_nilai semua aturan, ambil aturan dengan max_nilai tertinggi (paling berat)
        if (!$aturan) {
            $aturan = AturanHukum::where('jenis_pelanggaran_id', $barcode->jenis_pelanggaran_id)
                ->orderByDesc('max_nilai')
                ->first();
        }

        // Simpan pelanggaran dengan 'nilai' yang diisi skor poin
        $poinPelanggaran = $aturan ? $aturan->poin_pelanggaran : 0;

        $pelanggaran = PelanggaranSiswa::create([
            'siswa_id' => $siswa->id,
            'barcode_id' => $barcode->id,
            'aturan_id' => $aturan?->id,
            'nilai' => $poinPelanggaran,
            'scan_at' => now(),
            'status' => 'pending',
        ]);

        return view('scan.hasil', compact('siswa', 'barcode', 'pelanggaran', 'aturan'));
    }
}