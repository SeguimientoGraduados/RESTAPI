<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICiudadRepository;
use App\Models\Ciudad;

class CiudadRepository implements ICiudadRepository 
{
    public function obtenerTodasLasCiudades(){
        return Ciudad::all();
    }
}