<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $fillable = [
        'id', 
        'id_kategori', 
        'nama_pekerjaan', 
        'jenis_pekerjaan', 
        'id_lokasi', 
        'id_kontak', 
        'gaji', 
        'tanggal_dibuka', 
        'tanggal_ditutup', 
        'deskripsi_pekerjaan', 
        'kualifikasi', 
        'gambaran_perusahaan', 
        'keahlian_dibutuhkan'
    ];
}
