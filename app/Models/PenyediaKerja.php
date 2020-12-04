<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaKerja extends Model
{
    use HasFactory;
    protected $table = 'penyedia_kerja';
    protected $fillable = [
        'id_penyedia_kerja', 
        'nama_perusahaan', 
        'bidang_usaha', 
        'id_lokasi', 
        'alamat_web', 
        'id_kontak', 
        'deskripsi_perusahaan', 
        'id_dokumen', 
        'logo_perusahaan'
    ];
}
