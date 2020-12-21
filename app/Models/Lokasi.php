<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'id',
        'id_penyedia_kerja',
        'nama_lokasi',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'id_kelurahan'
    ];

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi', 'id_provinsi');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'id_kota');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan', 'id_kelurahan');
    }
}
