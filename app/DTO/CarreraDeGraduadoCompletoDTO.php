<?php

namespace App\DTO;

class CarreraDeGraduadoCompletoDTO
{
    public int $id;
    public string $nombre;
    public string $anio_graduacion;
    public string $departamento;

    public function __construct(
        int $id,
        string $nombre,
        string $anio_graduacion,
        string $departamento,
        
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->anio_graduacion = $anio_graduacion;
        $this->departamento = $departamento;
    }
}