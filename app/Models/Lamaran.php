<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;
    protected $table = 'lamaran';
    protected $fillable = [
        'id_lowongan',
        'status_lamaran',
        'id_pencari_kerja',
        'alasan'
    ];

    public function lowongan()
    {
        return $this->belongsTo('App\Models\Lowongan' , 'id_lowongan');
    }

    public function pelamar()
    {
    	return $this->belongsTo('App\Models\PencariKerja', 'id_pencari_kerja');
    }
}
