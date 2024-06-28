<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudades';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'pais_id',
    ];
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
