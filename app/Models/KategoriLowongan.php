<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLowongan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'bidang_perusahaan';
    protected $fillable = [
        'id',
        'id_kategori_pekerjaan',
        'id_lowongan'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriPekerjaan', 'id_kategori_pekerjaan');
    }
}
