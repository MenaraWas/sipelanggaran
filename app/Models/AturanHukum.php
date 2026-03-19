<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanHukum extends Model
{
    protected $fillable = ['jenis_pelanggaran_id', 'min_nilai', 'max_nilai', 'poin_pelanggaran', 'hukuman'];

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }
}
