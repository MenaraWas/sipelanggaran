<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AturanHukum;
use App\Models\BarcodeHarian;

class JenisPelanggaran extends Model
{
    protected $fillable = ['nama', 'tipe_perhitungan', 'jam_batas_masuk'];

    public function aturanHukum()
    {
        return $this->hasMany(AturanHukum::class);
    }

    public function barcodeHarian()
    {
        return $this->hasMany(BarcodeHarian::class);
    }

    public function pelanggaran()
    {
        return $this->hasManyThrough(PelanggaranSiswa::class, BarcodeHarian::class, 'jenis_pelanggaran_id', 'barcode_id');
    }
}
