<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class Siswa extends Authenticatable
{
    protected $table = 'siswas';
    protected $fillable = ['nis', 'nama', 'kelas', 'jurusan', 'email', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function pelanggaran()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'siswa_id');
    }
}
