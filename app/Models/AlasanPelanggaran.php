<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlasanPelanggaran extends Model
{
    protected $fillable = ['jenis_pelanggaran_id', 'teks', 'urutan'];

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }

    public function pelanggaranSiswas()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'alasan_id');
    }
}
