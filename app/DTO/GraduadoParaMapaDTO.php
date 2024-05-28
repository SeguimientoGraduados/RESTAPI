<?php

namespace App\DTO;

class GraduadoParaMapaDTO
{
    public int $id;
    public string $nombre;
    public array $carreras;
    public string $email;
    public ?string $ocupacion_trabajo;
    public ?string $ocupacion_empresa;
    public ?string $ocupacion_sector;
    public ?string $ocupacion_informacion_adicional;
    public ?string $experiencia_anios;

    public ?string $experiencia_informacion_adicional;
    public ?string $habilidades_competencias;

    public ?array $formacion;
    public ?array $rrss;
    public ?string $cv;

    public function __construct(
        int $id,
        string $nombre,
        array $carreras,
        string $email,
        ?string $ocupacion_trabajo = null,
        ?string $ocupacion_empresa = null,
        ?string $ocupacion_sector = null,
        ?string $ocupacion_informacion_adicional = null,
        ?string $experiencia_anios = null,
        ?string $experiencia_informacion_adicional = null,
        ?string $habilidades_competencias = null,
        ?array $formacion = null,
        ?array $rrss = null,
        string $cv = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->carreras = $carreras;
        $this->email = $email;
        $this->ocupacion_trabajo = $ocupacion_trabajo;
        $this->ocupacion_empresa = $ocupacion_empresa;
        $this->ocupacion_sector = $ocupacion_sector;
        $this->ocupacion_informacion_adicional = $ocupacion_informacion_adicional;
        $this->experiencia_anios = $experiencia_anios;
        $this->experiencia_informacion_adicional = $experiencia_informacion_adicional;
        $this->habilidades_competencias = $habilidades_competencias;
        $this->formacion = $formacion;
        $this->rrss = $rrss;
        $this->cv = $cv;
    }
}