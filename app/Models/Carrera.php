<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    
    public function graduados()
    {
        return $this->belongsToMany(Graduado::class, 'carrera_graduado', 'carrera_id', 'graduado_id');
    }
}
