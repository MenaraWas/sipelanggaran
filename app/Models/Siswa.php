<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class Siswa extends Authenticatable
{
    protected $table = 'siswas';
    protected $fillable = [
        'nis', 
        'nama', 
        'nik', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'no_telepon', 
        'nama_ayah', 
        'nama_ibu', 
        'nama_wali', 
        'kelas', 
        'jurusan', 
        'email', 
        'password', 
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'    => 'hashed',
        'is_verified' => 'boolean',
    ];

    public function pelanggaran()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'siswa_id');
    }
}
