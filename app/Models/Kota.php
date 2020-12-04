<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'indonesia_cities';
    protected $fillable = [
        'id', 
        'province_id', 
        'name'
    ];
}
