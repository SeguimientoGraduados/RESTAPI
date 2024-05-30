<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICarreraRepository;
use App\Models\Carrera;

class CarreraRepository implements ICarreraRepository 
{
    public function obtenerTodasLasCarreras(){
        return Carrera::all();
    }
}