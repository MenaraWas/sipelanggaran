<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AturanHukum;
use App\Models\BarcodeHarian;

class JenisPelanggaran extends Model
{
    protected $fillable = ['nama', 'kategori', 'satuan', 'is_akumulatif'];

    protected $casts = ['is_akumulatif' => 'boolean'];

    public function aturanHukum()
    {
        return $this->hasMany(AturanHukum::class);
    }

    public function barcodeHarian()
    {
        return $this->hasMany(BarcodeHarian::class);
    }
}
