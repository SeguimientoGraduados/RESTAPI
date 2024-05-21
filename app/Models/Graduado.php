<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduado extends Model
{
    use HasFactory;

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_graduado', 'graduado_id', 'carrera_id');
    }
}
