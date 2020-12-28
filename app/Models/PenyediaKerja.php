<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaKerja extends Model
{
    use HasFactory;
    protected $table = 'penyedia_kerja';
    protected $fillable = [
        'id_user',
        'nama_perusahaan',
        'alamat_web',
        'deskripsi_perusahaan',
        'logo_perusahaan',
        'status_perusahaan'
    ];

    public function kontak()
    {
        return $this->hasOne('App\Models\Kontak' , 'id_penyedia_kerja');
    }

    public function lokasi()
    {
        return $this->hasOne('App\Models\Lokasi', 'id_penyedia_kerja');
    }

    public function dokumen()
    {
        return $this->hasOne('App\Models\DokumenPerusahaan', 'id_penyedia_kerja');
    }

    public function bidangs()
    {
        return $this->hasMany('App\Models\BidangPerusahaan', 'id_penyedia_kerja');
    }

    public function kategori()
    {
    	return $this->belongsToMany('App\Models\KategoriPekerjaan');
    }
}
