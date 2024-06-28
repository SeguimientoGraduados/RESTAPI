<?php

namespace App\DTO;

class GraduadoParaExcelDTO
{
    public string $nombre;
    public string $contacto;
    public function __construct(
        string $nombre,
        string $contacto,
    ) {
        $this->nombre = $nombre;
        $this->contacto = $contacto;
    }
}