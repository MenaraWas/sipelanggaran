<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaEmailUpdate implements ToCollection
{
    public $updatedCount = 0;
    public $skippedCount = 0;
    public $skippedLog = [];

    public function collection(Collection $rows)
    {
        $nameIndex = null;
        $emailIndex = null;
        $headerFound = false;

        foreach ($rows as $rowIndex => $row) {
            $rowArray = $row->toArray();

            // 1. Cari Baris Header jika belum ditemukan
            if (!$headerFound) {
                foreach ($rowArray as $colIndex => $value) {
                    $val = strtoupper(trim($value));
                    
                    // Cari kolom Nama
                    if ($nameIndex === null && (str_contains($val, 'NAMA') || str_contains($val, 'NAME'))) {
                        $nameIndex = $colIndex;
                    }
                    
                    // Cari kolom User/Email
                    if ($emailIndex === null && (str_contains($val, 'USER') || str_contains($val, 'EMAIL') || str_contains($val, 'AKUN'))) {
                        $emailIndex = $colIndex;
                    }
                }

                if ($nameIndex !== null && $emailIndex !== null) {
                    $headerFound = true;
                    continue; // Skip baris header itu sendiri
                }
                continue; // Terus cari di baris berikutnya
            }

            // 2. Proses Data (Setelah header ditemukan)
            $nameCandidate = $rowArray[$nameIndex] ?? null;
            $emailCandidate = $rowArray[$emailIndex] ?? null;

            if (empty($nameCandidate)) {
                $this->skippedCount++;
                $this->skippedLog[] = "Baris " . ($rowIndex + 1) . ": Nama kosong";
                continue;
            }

            if (empty($emailCandidate)) {
                $this->skippedCount++;
                $this->skippedLog[] = "Siswa " . $nameCandidate . ": Email kosong";
                continue;
            }

            // Normalisasi & Matching
            $cleanName = preg_replace('/[[:^print:]]/', '', $nameCandidate);
            $cleanName = trim($cleanName);

            if (preg_match('/[0-9]/', $cleanName)) {
                $cleanName = trim(preg_replace('/[0-9].*$/', '', $cleanName));
            }

            $cleanName = preg_replace('/\s+/', ' ', $cleanName);

            // Pencocokan Database
            $students = Siswa::whereRaw('LOWER(nama) = ?', [strtolower($cleanName)])->get();

            if ($students->isEmpty()) {
                $students = Siswa::where('nama', 'LIKE', '%' . $cleanName . '%')->get();
            }

            if ($students->count() === 1) {
                $students->first()->update(['email' => $emailCandidate]);
                $this->updatedCount++;
            } elseif ($students->count() > 1) {
                $this->skippedCount++;
                $this->skippedLog[] = "Siswa " . $nameCandidate . ": Ditemukan " . $students->count() . " siswa dengan nama mirip";
            } else {
                $this->skippedCount++;
                $this->skippedLog[] = "Siswa " . $nameCandidate . ": Tidak ditemukan di database";
            }
        }

        // Jika sampai akhir tidak ketemu header
        if (!$headerFound) {
            $this->skippedLog[] = "ERROR: Kolom 'NAMA' atau 'USER/EMAIL' tidak ditemukan di file Excel ini.";
        }
    }
}
