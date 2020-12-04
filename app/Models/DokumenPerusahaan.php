<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'dokumen_perusahaan';
    protected $fillable = [
        'id_dokumen', 
        'sop', 
        'surat_domisili', 
        'npwp'
    ];
}
