<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $fillable = ['nis', 'nama', 'kelas', 'jurusan'];

    public function pelanggaran()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'siswa_id');
    }
}
