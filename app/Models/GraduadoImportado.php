<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduadoImportado extends Model
{
    protected $table = 'graduados_importados';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'dni',
        'carrera',
        'nombre_final',
        'fecha_egreso',
    ];
}
