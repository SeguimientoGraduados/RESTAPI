<?php

namespace App\DTO;

class GraduadoParaMapaDTO
{
    public int $id;
    public string $nombre;
    public string $apellido;
    public string $dni;
    public string $fecha_nacimiento;
    public array $carreras;
    public string $email;
    public array $ocupaciones;
    public ?string $experiencia_anios;
    public ?string $habilidades_competencias;
    public ?array $formacion;
    public ?array $rrss;
    public ?string $cv;
    public function __construct(
        int $id,
        string $nombre,
        string $apellido,
        string $dni,
        string $fecha_nacimiento,
        array $carreras,
        string $email,
        array $ocupaciones,
        ?string $experiencia_anios = null,
        ?string $habilidades_competencias = null,
        ?array $formacion = null,
        ?array $rrss = null,
        string $cv = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->carreras = $carreras;
        $this->email = $email;
        $this->ocupaciones = $ocupaciones;
        $this->experiencia_anios = $experiencia_anios;
        $this->habilidades_competencias = $habilidades_competencias;
        $this->formacion = $formacion;
        $this->rrss = $rrss;
        $this->cv = $cv;
    }
}