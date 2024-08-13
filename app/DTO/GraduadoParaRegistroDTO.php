<?php

namespace App\DTO;

class GraduadoParaRegistroDTO
{
    public string $nombre;
    public string $apellido;
    public string $dni;
    public string $fecha_nacimiento;
    public array $ciudad;
    public string $contacto;
    public ?array $carreras;
    public array $ocupaciones;
    public ?string $experiencia_anios;
    public ?string $habilidades_competencias;
    public ?array $formacion;
    public ?array $rrss;
    public ?string $cv;
    public bool $interes_comunidad;
    public bool $interes_oferta;
    public bool $interes_demanda;
    public bool $visibilidad_contacto;
    public bool $visibilidad_laboral;
    public bool $visibilidad_formacion;

    public function __construct(
        string $nombre,
        string $apellido,
        string $dni,
        string $fecha_nacimiento,
        array $ciudad,
        string $contacto,
        array $carreras,
        bool $interes_comunidad,
        bool $interes_oferta,
        bool $interes_demanda,
        array $ocupaciones,
        ?string $experiencia_anios = null,
        ?string $habilidades_competencias = null,
        ?array $formacion = null,
        ?array $rrss = null,
        ?string $cv = null,
        bool $visibilidad_contacto,
        bool $visibilidad_laboral,
        bool $visibilidad_formacion,
    ) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->ciudad = $ciudad;
        $this->contacto = $contacto;
        $this->carreras = $carreras;
        $this->ocupaciones = $ocupaciones;
        $this->experiencia_anios = $experiencia_anios;
        $this->habilidades_competencias = $habilidades_competencias;
        $this->formacion = $formacion;
        $this->rrss = $rrss;
        $this->cv = $cv;
        $this->interes_comunidad = $interes_comunidad;
        $this->interes_oferta = $interes_oferta;
        $this->interes_demanda = $interes_demanda;
        $this->visibilidad_contacto = $visibilidad_contacto;
        $this->visibilidad_laboral = $visibilidad_laboral;
        $this->visibilidad_formacion = $visibilidad_formacion;
    }
}