<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'kategori_pekerjaan';
    protected $fillable = ['nama_kategori_pekerjaan'];

    public function penyedia()
    {
    	return $this->belongsToMany('App\Models\PenyediaKerja');
    }
}
