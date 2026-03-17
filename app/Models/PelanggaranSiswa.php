<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'barcode_id',
        'aturan_id',
        'nilai',
        'hukuman_override',
        'scan_at',
        'status'
    ];

    protected $casts = ['scan_at' => 'datetime'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function barcode()
    {
        return $this->belongsTo(BarcodeHarian::class, 'barcode_id');
    }

    public function aturan()
    {
        return $this->belongsTo(AturanHukum::class, 'aturan_id');
    }

    public function getHukumanAktifAttribute(): string
    {
        return $this->hukuman_override ?? $this->aturan?->hukuman ?? 'Belum ditentukan';
    }
}
