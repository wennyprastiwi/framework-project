<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'bidang_perusahaan';
    protected $fillable = [
        'id',
        'id_kategori_pekerjaan',
        'id_penyedia_kerja'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriPekerjaan', 'id_kategori_pekerjaan');
    }
}
