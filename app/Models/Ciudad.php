<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
    ];
    use HasFactory;
    protected $table = 'ciudades';
}
