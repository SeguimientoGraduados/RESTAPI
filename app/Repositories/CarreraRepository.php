<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICarreraRepository;
use App\DTO\CarreraDeGraduadoParaFormularioDTO;
use App\Models\Carrera;

class CarreraRepository implements ICarreraRepository
{
    public function obtenerTodasLasCarreras()
    {

        $carreras = Carrera::select('id', 'nombre')->get();

        $carrerasDTOs = $carreras->map(function ($carrera) {
            return new CarreraDeGraduadoParaFormularioDTO(
                $carrera->id,
                $carrera->nombre
            );
        });

        $result = $carrerasDTOs->toArray();

        return $result;
    }
}