<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerja extends Model
{
    use HasFactory;
    protected $table = 'pencari_kerja';
    protected $fillable = [
        'id', 
        'nama_lengkap', 
        'nik', 
        'jenis_kelamin', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'status_pernikahan', 
        'agama', 
        'id_lokasi', 
        'id_kontak', 
        'id_pekerjaan', 
        'id_sertifikasi', 
        'id_pendidikan', 
        'file_cv'
    ];
}
