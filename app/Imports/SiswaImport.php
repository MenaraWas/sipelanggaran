<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SiswaImport implements ToModel, WithHeadingRow, WithUpserts
{
    protected static $password;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pre-hash password once to save time
        if (!static::$password) {
            static::$password = Hash::make('man2bantul');
        }
        // Skip if name is missing
        if (empty($row['nama_lengkap'])) {
            return null;
        }

        // Handle Tanggal Lahir (Excel serial to Y-m-d or string to Y-m-d)
        $tanggalLahir = null;
        if (!empty($row['tanggal_lahir'])) {
            try {
                if (is_numeric($row['tanggal_lahir'])) {
                    $tanggalLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d');
                } else {
                    $tanggalLahir = date('Y-m-d', strtotime($row['tanggal_lahir']));
                }
            } catch (\Exception $e) {
                // Keep null if failed
            }
        }

        return new Siswa([
            'nis'           => $row['nisn'] ?? null,
            'nama'          => $row['nama_lengkap'],
            'nik'           => $row['nik'] ?? null,
            'tempat_lahir'  => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $tanggalLahir,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'alamat'        => $row['alamat'] ?? null,
            'no_telepon'    => $row['no_telepon'] ?? null,
            'nama_ayah'     => $row['nama_ayah_kandung'] ?? null,
            'nama_ibu'      => $row['nama_ibu_kandung'] ?? null,
            'nama_wali'     => $row['nama_wali'] ?? null,
            'kelas'         => $row['tingkat_rombel'] ?? 'XI - F',
            'jurusan'       => null, // Skipped as requested
            'password'      => static::$password,
            'is_verified'   => true,
        ]);
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'nis';
    }
}
