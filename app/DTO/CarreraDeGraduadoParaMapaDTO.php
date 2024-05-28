<?php

namespace App\DTO;

class CarreraDeGraduadoParaMapaDTO
{
    public int $id;
    public string $nombre;
    public string $departamento;

    public function __construct(
        int $id,
        string $nombre,
        string $departamento
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->departamento = $departamento;
    }
}