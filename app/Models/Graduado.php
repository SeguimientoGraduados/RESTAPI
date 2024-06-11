<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduado extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_graduado', 'graduado_id', 'carrera_id')->withPivot('anio_graduacion');
    }

    public function rrss()
    {
        return $this->hasMany(Contacto::class, 'graduado_id');
    }
}
