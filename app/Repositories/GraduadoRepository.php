<?php

namespace App\Repositories;

use App\Models\GraduadoImportado;
use App\Repositories\Interfaces\IGraduadoRepository;
use App\Models\Graduado;
use App\Models\Carrera;
use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Formacion;
use App\Models\Contacto;
use App\Models\Ocupacion;
use App\DTO\GraduadoParaMapaDTO;
use App\DTO\GraduadoParaEditarDTO;
use App\DTO\CarreraDeGraduadoCompletoDTO;
use App\DTO\CiudadDTO;
use App\DTO\GraduadoParaRegistroDTO;
use App\DTO\GraduadoPorValidarDTO;
use App\DTO\PaisParaFiltroDTO;
use App\DTO\DepartamentoParaFiltroDTO;
use App\DTO\CarreraParaFiltroDTO;
use Illuminate\Support\Facades\DB;


class GraduadoRepository implements IGraduadoRepository
{
    public function obtenerGraduadosConFiltros($filters = [], $isAdmin = false)
    {
        $query = Graduado::where('validado', true)->with(['carreras.departamento', 'ciudad.pais']);

        if (!empty($filters)) {
            if (isset($filters['ciudad'])) {
                $query->whereHas('ciudad', function ($q) use ($filters) {
                    $q->where('nombre', $filters['ciudad']);
                });
            }
            if (isset($filters['pais'])) {
                $query->whereHas('ciudad', function ($q) use ($filters) {
                    $q->where('pais_id', $filters['pais']);
                });
            }
            if (isset($filters['departamento'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('departamento_id', $filters['departamento']);
                });
            }
            if (isset($filters['carrera'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('carreras.id', $filters['carrera']);
                });
            }
            if (isset($filters['anioDesde'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('anio_graduacion', '>=', $filters['anioDesde']);
                });
            }
            if (isset($filters['anioHasta'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('anio_graduacion', '<=', $filters['anioHasta']);
                });
            }
            if (isset($filters['interes_comunidad'])) {
                $query->where('interes_comunidad', $filters['interes_comunidad']);
            }
            if (isset($filters['interes_oferta'])) {
                $query->where('interes_oferta', $filters['interes_oferta']);
            }
            if (isset($filters['interes_demanda'])) {
                $query->where('interes_demanda', $filters['interes_demanda']);
            }
        }

        $graduados = $query->get();
        $graduadosPorCiudad = $graduados->groupBy('ciudad_id');

        $result = [];

        foreach ($graduadosPorCiudad as $ciudadId => $graduados) {
            $ciudad = $graduados->first()->ciudad;
            $graduadoDTOs = $graduados->map(function ($graduado) use ($isAdmin) {
                $ocupaciones = $graduado->ocupaciones->map(function ($ocupacion) use ($isAdmin, $graduado) {
                    return [
                        'ocupacion_trabajo' => $isAdmin || $graduado->visibilidad_laboral ? $ocupacion->ocupacion_trabajo : null,
                        'ocupacion_empresa' => $isAdmin || $graduado->visibilidad_laboral ? $ocupacion->ocupacion_empresa : null,
                        'ocupacion_sector' => $isAdmin || $graduado->visibilidad_laboral ? $ocupacion->ocupacion_sector : null,
                        'ocupacion_informacion_adicional' => $isAdmin || $graduado->visibilidad_laboral ? $ocupacion->ocupacion_informacion_adicional : null,
                    ];
                })->toArray();

                return new GraduadoParaMapaDTO(
                    $graduado->id,
                    $graduado->nombre,
                    $graduado->apellido,
                    $isAdmin ? $graduado->dni : '',
                    $isAdmin ? $graduado->fecha_nacimiento : '',
                    $this->formatearCarreras($graduado->carreras),
                    $isAdmin || $graduado->visibilidad_contacto ? $graduado->contacto : '',
                    $ocupaciones,
                    $isAdmin || $graduado->visibilidad_laboral ? $this->formatearExperiencia($graduado->experiencia_anios) : '',
                    $isAdmin || $graduado->visibilidad_laboral ? $graduado->habilidades_competencias : null,
                    $isAdmin || $graduado->visibilidad_formacion ? ($graduado->formaciones ? $graduado->formaciones->toArray() : null) : [],
                    $isAdmin || $graduado->visibilidad_contacto ? ($graduado->rrss ? $graduado->rrss->toArray() : null) : [],
                    $graduado->cv
                );
            })->toArray();

            $result[] = [
                'ciudad' => [
                    'id' => $ciudad->id,
                    'nombre' => $ciudad->nombre,
                    'pais' => $ciudad->pais->nombre,
                    'latitud' => $ciudad->latitud,
                    'longitud' => $ciudad->longitud,
                    'cantidad_graduados' => $graduados->count(),
                    'graduados' => $graduadoDTOs,
                ],
            ];
        }


        return $result;
    }

    public function obtenerGraduado(string $email)
    {
        $graduado = Graduado::where('contacto', $email)->with(['carreras.departamento', 'ciudad.pais'])->firstOrFail();

        if ($graduado) {
            return new GraduadoParaEditarDTO(
                $graduado->nombre,
                $graduado->apellido,
                $graduado->dni,
                $graduado->contacto,
                $graduado->fecha_nacimiento,
                $graduado->ciudad->nombre,
                $graduado->ciudad->latitud,
                $graduado->ciudad->longitud,
                $graduado->ciudad->pais->nombre,
                $this->formatearCarreras($graduado->carreras),
                $graduado->interes_comunidad,
                $graduado->interes_oferta,
                $graduado->interes_demanda,
                $graduado->ocupaciones ? $graduado->ocupaciones->toArray() : null,
                $graduado->experiencia_anios,
                $graduado->habilidades_competencias,
                $graduado->formaciones ? $graduado->formaciones->toArray() : null,
                $graduado->rrss ? $graduado->rrss->toArray() : null,
                $graduado->cv,
                $graduado->visibilidad_contacto,
                $graduado->visibilidad_laboral,
                $graduado->visibilidad_formacion
            );
        } else {
            return ['error' => "Graduado con correo {$email} no encontrado."];
        }
    }


    public function registrarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO)
    {
        DB::beginTransaction();

        try {

            $graduado = new Graduado();
            $graduado->nombre = $graduadoParaRegistroDTO->nombre;
            $graduado->apellido = $graduadoParaRegistroDTO->apellido;
            $graduado->dni = $graduadoParaRegistroDTO->dni;
            $graduado->fecha_nacimiento = $graduadoParaRegistroDTO->fecha_nacimiento;
            $graduado->contacto = $graduadoParaRegistroDTO->contacto;
            $graduado->experiencia_anios = $graduadoParaRegistroDTO->experiencia_anios;
            $graduado->habilidades_competencias = $graduadoParaRegistroDTO->habilidades_competencias;
            $graduado->cv = $graduadoParaRegistroDTO->cv;
            $graduado->interes_comunidad = $graduadoParaRegistroDTO->interes_comunidad;
            $graduado->interes_oferta = $graduadoParaRegistroDTO->interes_oferta;
            $graduado->interes_demanda = $graduadoParaRegistroDTO->interes_demanda;
            $graduado->visibilidad_contacto = $graduadoParaRegistroDTO->visibilidad_contacto;
            $graduado->visibilidad_laboral = $graduadoParaRegistroDTO->visibilidad_laboral;
            $graduado->visibilidad_formacion = $graduadoParaRegistroDTO->visibilidad_formacion;

            $ciudadDTO = new CiudadDTO(
                $graduadoParaRegistroDTO->ciudad['nombre'],
                $graduadoParaRegistroDTO->ciudad['latitud'],
                $graduadoParaRegistroDTO->ciudad['longitud'],
                $graduadoParaRegistroDTO->ciudad['pais'],
            );

            $ciudad = Ciudad::where('nombre', $ciudadDTO->nombre)->first();
            if (!$ciudad) {
                $pais = Pais::firstOrCreate(['nombre' => $ciudadDTO->pais]);
                $ciudad = Ciudad::create([
                    'nombre' => $ciudadDTO->nombre,
                    'latitud' => $ciudadDTO->latitud,
                    'longitud' => $ciudadDTO->longitud,
                    'pais_id' => $pais->id
                ]);
            }

            $graduado->ciudad_id = $ciudad->id;

            $graduado->save();

            if ($graduadoParaRegistroDTO->carreras) {
                foreach ($graduadoParaRegistroDTO->carreras as $carreraData) {
                    $carrera = Carrera::find($carreraData['carrera_id']);
                    if (!$carrera) {
                        DB::rollBack();
                        return ['error' => "Carrera con ID {$carreraData['carrera_id']} no encontrada"];
                    }
                    $graduado->carreras()->attach($carrera->id, ['anio_graduacion' => $carreraData['anio_graduacion']]);
                }
            }

            foreach ($graduadoParaRegistroDTO->ocupaciones as $ocupacionData) {
                $ocupacion = Ocupacion::firstOrCreate([
                    'ocupacion_trabajo' => $ocupacionData['ocupacion_trabajo'],
                    'ocupacion_empresa' => $ocupacionData['ocupacion_empresa'],
                    'ocupacion_sector' => $ocupacionData['ocupacion_sector'],
                    'ocupacion_informacion_adicional' => $ocupacionData['ocupacion_informacion_adicional'],
                    'graduado_id' => $graduado->id
                ]);
            }

            if ($graduadoParaRegistroDTO->formacion) {
                foreach ($graduadoParaRegistroDTO->formacion as $formacionData) {
                    $formacion = Formacion::firstOrCreate([
                        'titulo' => $formacionData['titulo'],
                        'institucion' => $formacionData['institucion'],
                        'nivel' => $formacionData['nivel'],
                        'graduado_id' => $graduado->id
                    ]);
                }
            }

            if ($graduadoParaRegistroDTO->rrss) {
                foreach ($graduadoParaRegistroDTO->rrss as $rrssData) {
                    $contacto = Contacto::firstOrCreate([
                        'rrss' => $rrssData['rrss'],
                        'url' => $rrssData['url'],
                        'graduado_id' => $graduado->id
                    ]);
                }
            }
            if ($this->verificarGraduadoEnCsv($graduadoParaRegistroDTO)) {
                $this->aprobarGraduado($graduado->id);
            }
            $graduado->save();
            DB::commit();
            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => 'Hubo un error al registrar el graduado: ' . $e->getMessage()
            ];
        }
    }

    public function verificarGraduadoEnCsv(GraduadoParaRegistroDTO $graduadoParaRegistroDTO)
    {

        $graduado = GraduadoImportado::where('dni', $graduadoParaRegistroDTO->dni)->first();

        if ($graduado) {
            $primeraCarrera = !empty($graduadoParaRegistroDTO->carreras) ? $graduadoParaRegistroDTO->carreras[0] : null;

            return $graduado->carrera == $primeraCarrera;
        }

        return false;
    }

    public function actualizarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO)
    {
        DB::beginTransaction();

        try {
            $graduado = Graduado::where('contacto', $graduadoParaRegistroDTO->contacto)->firstOrFail();
            $graduado->nombre = $graduadoParaRegistroDTO->nombre;
            $graduado->apellido = $graduadoParaRegistroDTO->apellido;
            $graduado->dni = $graduadoParaRegistroDTO->dni;
            $graduado->fecha_nacimiento = $graduadoParaRegistroDTO->fecha_nacimiento;
            $graduado->contacto = $graduadoParaRegistroDTO->contacto;
            //$graduado->ocupaciones = $graduadoParaRegistroDTO->ocupaciones;
            $graduado->experiencia_anios = $graduadoParaRegistroDTO->experiencia_anios;
            $graduado->habilidades_competencias = $graduadoParaRegistroDTO->habilidades_competencias;
            $graduado->cv = $graduadoParaRegistroDTO->cv;
            $graduado->interes_comunidad = $graduadoParaRegistroDTO->interes_comunidad;
            $graduado->interes_oferta = $graduadoParaRegistroDTO->interes_oferta;
            $graduado->interes_demanda = $graduadoParaRegistroDTO->interes_demanda;
            $graduado->visibilidad_contacto = $graduadoParaRegistroDTO->visibilidad_contacto;
            $graduado->visibilidad_laboral = $graduadoParaRegistroDTO->visibilidad_laboral;
            $graduado->visibilidad_formacion = $graduadoParaRegistroDTO->visibilidad_formacion;

            $ciudadDTO = new CiudadDTO(
                $graduadoParaRegistroDTO->ciudad['nombre'],
                $graduadoParaRegistroDTO->ciudad['latitud'],
                $graduadoParaRegistroDTO->ciudad['longitud'],
                $graduadoParaRegistroDTO->ciudad['pais'],
            );

            $ciudad = Ciudad::where('nombre', $ciudadDTO->nombre)->first();
            if (!$ciudad) {
                $pais = Pais::firstOrCreate(['nombre' => $ciudadDTO->pais]);
                $ciudad = Ciudad::create([
                    'nombre' => $ciudadDTO->nombre,
                    'latitud' => $ciudadDTO->latitud,
                    'longitud' => $ciudadDTO->longitud,
                    'pais_id' => $pais->id
                ]);
            }

            $graduado->ciudad()->associate($ciudad);

            $graduado->save();

            if ($graduadoParaRegistroDTO->carreras) {
                $graduado->carreras()->detach();
                foreach ($graduadoParaRegistroDTO->carreras as $carreraData) {
                    $carrera = Carrera::find($carreraData['carrera_id']);
                    if (!$carrera) {
                        DB::rollBack();
                        return ['error' => "Carrera con ID {$carreraData['carrera_id']} no encontrada"];
                    }
                    $graduado->carreras()->attach($carrera->id, ['anio_graduacion' => $carreraData['anio_graduacion']]);
                }
            }

            $graduado->ocupaciones()->delete();
            foreach ($graduadoParaRegistroDTO->ocupaciones as $ocupacionData) {
                $ocupacion = Ocupacion::firstOrCreate([
                    'ocupacion_trabajo' => $ocupacionData['ocupacion_trabajo'],
                    'ocupacion_empresa' => $ocupacionData['ocupacion_empresa'],
                    'ocupacion_sector' => $ocupacionData['ocupacion_sector'],
                    'ocupacion_informacion_adicional' => $ocupacionData['ocupacion_informacion_adicional'],
                    'graduado_id' => $graduado->id
                ]);
            }


            if ($graduadoParaRegistroDTO->formacion) {
                $graduado->formaciones()->delete();
                foreach ($graduadoParaRegistroDTO->formacion as $formacionData) {
                    $graduado->formaciones()->create([
                        'titulo' => $formacionData['titulo'],
                        'institucion' => $formacionData['institucion'],
                        'nivel' => $formacionData['nivel'],
                    ]);
                }
            }

            if ($graduadoParaRegistroDTO->rrss) {
                $graduado->rrss()->delete();
                foreach ($graduadoParaRegistroDTO->rrss as $rrssData) {
                    $graduado->rrss()->create([
                        'rrss' => $rrssData['rrss'],
                        'url' => $rrssData['url'],
                    ]);
                }
            }

            DB::commit();
            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => 'Hubo un error al actualizar el graduado: ' . $e->getMessage()
            ];
        }
    }

    public function obtenerGraduadosPorValidar($cantPagina = 10)
    {
        $graduados = Graduado::where('validado', 'false')
            ->with(['carreras.departamento', 'ocupaciones'])
            ->paginate($cantPagina);
    
        $graduadosDTOs = $graduados->getCollection()->map(function ($graduado) {
            $ocupaciones = $graduado->ocupaciones->map(function ($ocupacion) use ($graduado) {
                return [
                    'ocupacion_trabajo' => $this->formatearTrabajo($ocupacion->ocupacion_trabajo),
                    'ocupacion_empresa' => $ocupacion->ocupacion_empresa,
                    'ocupacion_sector' => $this->formatearSectorTrabajo($ocupacion->ocupacion_sector),
                    'ocupacion_informacion_adicional' => $ocupacion->ocupacion_informacion_adicional,
                ];
            })->toArray();
    
            return new GraduadoPorValidarDTO(
                $graduado->id,
                $graduado->nombre,
                $graduado->apellido,
                $graduado->dni,
                $graduado->fecha_nacimiento,
                $this->formatearCarreras($graduado->carreras),
                $ocupaciones,
                $this->formatearExperiencia($graduado->experiencia_anios),
                $graduado->habilidades_competencias,
                $graduado->cv
            );
        });
    
        $graduados->setCollection($graduadosDTOs);
    
        return $graduados;
    }
    

    public function aprobarGraduado($graduado_id)
    {
        $graduado = Graduado::findOrFail($graduado_id);
        if (!$graduado) {
            return ['error' => "Graduado con ID {$graduado_id} no encontrado."];
        }
        if ($graduado->validado) {
            return ['error' => "Graduado con ID {$graduado_id} ya estaba validado."];
        }
        $graduado->validado = true;
        $graduado->save();
        return ['success' => true];
    }

    public function rechazarGraduado($graduado_id)
    {
        $graduado = Graduado::findOrFail($graduado_id);
        if (!$graduado) {
            return ['error' => "Graduado con ID {$graduado_id} no encontrado."];
        }
        $graduado->delete();
        return ['success' => true];
    }

    public function obtenerEmailGraduado($graduado_id)
    {
        $graduado = Graduado::findOrFail($graduado_id);
        if (!$graduado) {
            return ['error' => "Graduado con ID {$graduado_id} no encontrado."];
        }
        return $graduado->contacto;
    }

    public function obtenerValoresParaFiltrar($filters = [])
    {
        $query = Graduado::where('validado', true)
            ->with(['carreras.departamento', 'ciudad.pais']);

        $graduados = $query->get();

        $paisesIds = $graduados->pluck('ciudad.pais.id')->unique()->values();
        $departamentosIds = $graduados->pluck('carreras.*.departamento.id')->flatten()->unique()->values();
        $carrerasIds = $graduados->pluck('carreras.*.id')->flatten()->unique()->values();

        $paises = Pais::whereIn('id', $paisesIds)->get(['id', 'nombre']);
        $departamentos = Departamento::whereIn('id', $departamentosIds)->get(['id', 'nombre']);
        $carreras = Carrera::whereIn('id', $carrerasIds)->get(['id', 'nombre']);

        $paisesDTOs = $paises->map(fn($pais) => new PaisParaFiltroDTO($pais->id, $pais->nombre));
        $departamentosDTOs = $departamentos->map(fn($departamento) => new DepartamentoParaFiltroDTO($departamento->id, $departamento->nombre));
        $carrerasDTOs = $carreras->map(fn($carrera) => new CarreraParaFiltroDTO($carrera->id, $carrera->nombre));

        $anioMin = $graduados->pluck('carreras.*.pivot.anio_graduacion')->flatten()->min();
        $anioMax = $graduados->pluck('carreras.*.pivot.anio_graduacion')->flatten()->max();
        $rangoAnios = ['anio_min' => $anioMin, 'anio_max' => $anioMax];

        return [
            'paises' => $paisesDTOs,
            'departamentos' => $departamentosDTOs,
            'carreras' => $carrerasDTOs,
            'anios' => $rangoAnios
        ];
    }

    private function formatearCarreras($carreras): array
    {
        return $carreras->map(function ($carrera) {
            return new CarreraDeGraduadoCompletoDTO(
                $carrera->id,
                $carrera->nombre,
                $carrera->pivot->anio_graduacion,
                $carrera->departamento->nombre,
            );
        })->toArray();
    }

    private function formatearExperiencia(?string $experiencia): ?string
    {
        if (is_null($experiencia)) {
            return null;
        }

        switch ($experiencia) {
            case 'menos_5':
                return 'Menos de 5 años';
            case 'de_5_a_10':
                return 'De 5 a 10 años';
            case 'de_10_a_20':
                return 'De 10 a 20 años';
            case 'mas_20':
                return 'Más de 20 años';
            default:
                return 'Experiencia no especificada';
        }
    }

    private function formatearTrabajo(?string $trabajo): ?string
    {
        if (is_null($trabajo)) {
            return null;
        }

        if ($trabajo == "rel_dependencia") {
            return 'Relación de dependencia';
        }
        if ($trabajo == "autonomo") {
            return 'Autónomo';
        }
    }

    private function formatearSectorTrabajo(?string $sector): ?string
    {
        if (is_null($sector)) {
            return null;
        }

        if ($sector == "publico") {
            return 'Público';
        }
        if ($sector == "privado") {
            return 'Privado';
        }
    }
}
