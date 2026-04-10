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
        'alasan_id',
        'alasan_custom',
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

    public function alasan()
    {
        return $this->belongsTo(AlasanPelanggaran::class, 'alasan_id');
    }

    public function getAlasanTeksAttribute(): ?string
    {
        if ($this->alasan_id) {
            return $this->alasan?->teks;
        }
        return $this->alasan_custom;
    }

    public function getHukumanAktifAttribute(): string
    {
        return $this->hukuman_override ?? $this->aturan?->hukuman ?? 'Belum ditentukan';
    }
}
