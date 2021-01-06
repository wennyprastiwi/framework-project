<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerja extends Model
{
    use HasFactory;
    protected $table = 'pencari_kerja';
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_pernikahan',
        'agama',
        'file_cv',
        'status_pencari'
    ];

    public function lokasi()
    {
        return $this->hasOne('App\Models\LokasiPencari', 'id_pencari_kerja');
    }

    public function agama()
    {
        return $this->belongsTo('App\Models\Agama');
    }
}
