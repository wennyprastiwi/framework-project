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
        'alamat_perusahaan',
        'kecamatan',
        'kelurahan',
        'kota',
        'provinsi',
        'id_kontak',
        'deskripsi_perusahaan',
        'logo_perusahaan'
    ];

    public function kontak()
    {
        return $this->hasOne('App\Models\Kontak');
    }
}
