<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $fillable = [
        'id_penyedia_kerja',
        'nama_pekerjaan',
        'gaji',
        'tanggal_dibuka',
        'tanggal_ditutup',
        'deskripsi_pekerjaan',
        'kualifikasi',
        'gambaran_perusahaan',
        'keahlian_dibutuhkan'
    ];

    public function kategoriLoker()
    {
    	return $this->belongsToMany('App\Models\KategoriPekerjaan');
    }

    public function lokasiLoker()
    {
    	return $this->belongsToMany('App\Models\LokasiLowongan');
    }

    public function perusahaan()
    {
        return $this->belongsTo('App\Models\PenyediaKerja', 'id_penyedia_kerja');
    }
}
