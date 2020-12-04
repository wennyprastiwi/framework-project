<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'indonesia_districts';
    protected $fillable = [
        'id', 
        'city_id', 
        'name'
    ];
}
