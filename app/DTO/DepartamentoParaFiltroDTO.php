<?php

namespace App\DTO;

class DepartamentoParaFiltroDTO
{
    public $id;
    public string $nombre;
    public function __construct(
        int $id,
        string $nombre,
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}