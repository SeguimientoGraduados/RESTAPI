<?php

namespace App\DTO;

class GraduadoParaExcelDTO
{
    public string $contacto;
    public function __construct(
        string $contacto,
    ) {
        $this->contacto = $contacto;
    }
}