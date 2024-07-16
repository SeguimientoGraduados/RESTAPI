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
    public ?string $ocupacion_trabajo;
    public ?string $ocupacion_empresa;
    public ?string $ocupacion_sector;
    public ?string $ocupacion_informacion_adicional;
    public ?string $experiencia_anios;
    public ?string $habilidades_competencias;
    public bool $interes_comunidad;
    public bool $interes_oferta;
    public bool $interes_demanda;
    public bool $visibilidad_contacto;
    public bool $visibilidad_laboral;
    public bool $visibilidad_formacion;
    public function __construct(
        int $id,
        string $nombre,
        string $apellido,
        string $dni,
        string $fecha_nacimiento,
        array $carreras,
        bool $interes_comunidad,
        bool $interes_oferta,
        bool $interes_demanda,
        ?string $ocupacion_trabajo = null,
        ?string $ocupacion_empresa = null,
        ?string $ocupacion_sector = null,
        ?string $ocupacion_informacion_adicional = null,
        ?string $experiencia_anios = null,
        ?string $habilidades_competencias = null,
        bool $visibilidad_contacto,
        bool $visibilidad_laboral,
        bool $visibilidad_formacion,
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->carreras = $carreras;
        $this->ocupacion_trabajo = $ocupacion_trabajo;
        $this->ocupacion_empresa = $ocupacion_empresa;
        $this->ocupacion_sector = $ocupacion_sector;
        $this->ocupacion_informacion_adicional = $ocupacion_informacion_adicional;
        $this->experiencia_anios = $experiencia_anios;
        $this->habilidades_competencias = $habilidades_competencias;
        $this->interes_comunidad = $interes_comunidad;
        $this->interes_oferta = $interes_oferta;
        $this->interes_demanda = $interes_demanda;
        $this->visibilidad_contacto = $visibilidad_contacto;
        $this->visibilidad_laboral = $visibilidad_laboral;
        $this->visibilidad_formacion = $visibilidad_formacion;
    }
}