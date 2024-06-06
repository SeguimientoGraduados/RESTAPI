<?php

namespace App\DTO;

class CiudadDeGraduadoParaRegistroDTO
{

    public string $nombre;
    public string $latitud;
    public string $longitud;

    public function __construct(
        string $nombre,
        string $latitud,
        string $longitud,
    ) {
        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }
}