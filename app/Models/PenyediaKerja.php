<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaKerja extends Model
{
    use HasFactory;
    protected $table = 'penyedia_kerja';
    protected $fillable = [
        'nama_perusahaan', 
        'bidang_usaha', 
        'alamat_web', 
        'deskripsi_perusahaan', 
        'logo_perusahaan'
    ];
}
