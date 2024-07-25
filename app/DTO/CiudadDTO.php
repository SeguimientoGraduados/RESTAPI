<?php

namespace App\DTO;

class CiudadDTO
{

    public string $nombre;
    public string $latitud;
    public string $longitud;
    public string $pais;

    public function __construct(
        string $nombre,
        string $latitud,
        string $longitud,
        string $pais
    ) {
        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->pais = $pais;
    }
}