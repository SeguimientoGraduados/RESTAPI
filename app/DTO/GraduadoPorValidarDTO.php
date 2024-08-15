<?php

namespace App\DTO;

class GraduadoPorValidarDTO
{
    public $id;
    public string $nombre;
    public string $apellido;
    public string $dni;
    public string $fecha_nacimiento;
    public ?array $carreras;
    public ?array $ocupaciones;
    public ?string $experiencia_anios;
    public ?string $habilidades_competencias;
    public ?string $cv;
    public function __construct(
        int $id,
        string $nombre,
        string $apellido,
        string $dni,
        string $fecha_nacimiento,
        array $carreras,
        ?array $ocupaciones = null,
        ?string $experiencia_anios = null,
        ?string $habilidades_competencias = null,
        ?string $cv = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->carreras = $carreras;
        $this->ocupaciones = $ocupaciones;
        $this->experiencia_anios = $experiencia_anios;
        $this->habilidades_competencias = $habilidades_competencias;
        $this->cv = $cv;
    }
}