<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BarcodeHarian extends Model
{
     protected $fillable = [
        'jenis_pelanggaran_id', 'tanggal', 'token',
        'nilai_default', 'dibuat_oleh', 'expired_at'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'expired_at' => 'datetime',
    ];

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }

    public function pembuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function pelanggaran()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'barcode_id');
    }

    public function isExpired(): bool
    {
        return now()->isAfter($this->expired_at);
    }

    public static function generateToken(): string
    {
        return hash('sha256', Str::random(64) . now()->timestamp);
    }
}
