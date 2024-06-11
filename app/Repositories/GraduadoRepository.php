<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IGraduadoRepository;
use App\Models\Graduado;
use App\Models\Carrera;
use App\Models\Ciudad;
use App\Models\Formacion;
use App\Models\Contacto;
use App\DTO\GraduadoParaMapaDTO;
use App\DTO\CarreraDeGraduadoCompletoDTO;
use App\DTO\CiudadDeGraduadoParaRegistroDTO;
use App\DTO\GraduadoParaRegistroDTO;
use App\DTO\GraduadoPorValidarDTO;
use Illuminate\Support\Facades\DB;


class GraduadoRepository implements IGraduadoRepository
{
    public function obtenerGraduadosConFiltros($filters = [])
    {
        $query = Graduado::where('validado', true)->with(['carreras.departamento', 'ciudad']);

        if (!empty($filters)) {
            if (isset($filters['nombre'])) {
                $query->where('nombre', 'like', '%' . $filters['nombre'] . '%');
            }
            if (isset($filters['anio'])) {
                $query->where('anio_graduacion', $filters['anio']);
            }
            if (isset($filters['titulo'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('carreras.id', $filters['titulo']);
                });
            }
            if (isset($filters['departamento'])) {
                $query->whereHas('carreras', function ($q) use ($filters) {
                    $q->where('departamento_id', $filters['departamento']);
                });
            }
        }

        $graduados = $query->get();
        $graduadosPorCiudad = $graduados->groupBy('ciudad_id');

        $result = [];

        foreach ($graduadosPorCiudad as $ciudadId => $graduados) {
            $ciudad = $graduados->first()->ciudad;
            $graduadoDTOs = $graduados->map(function ($graduado) {
                return new GraduadoParaMapaDTO(
                    $graduado->id,
                    $graduado->nombre,
                    $this->formatearCarreras($graduado->carreras),
                    $graduado->contacto,
                    $graduado->ocupacion_trabajo,
                    $graduado->ocupacion_empresa,
                    $graduado->ocupacion_sector,
                    $graduado->ocupacion_informacion_adicional,
                    $this->formatearExperiencia($graduado->experiencia_anios),
                    $graduado->habilidades_competencias,
                    $graduado->formacion ? $graduado->formacion->toArray() : null,
                    $graduado->rrss ? $graduado->rrss->toArray() : null,
                    $graduado->cv
                );
            })->toArray();

            $result[] = [
                'ciudad' => [
                    'id' => $ciudad->id,
                    'nombre' => $ciudad->nombre,
                    'latitud' => $ciudad->latitud,
                    'longitud' => $ciudad->longitud,
                    'cantidad_graduados' => $graduados->count(),
                    'graduados' => $graduadoDTOs,
                ],
            ];
        }

        return $result;
    }

    public function registrarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO)
    {
        DB::beginTransaction();

        try {

            $graduado = new Graduado();
            $graduado->nombre = $graduadoParaRegistroDTO->nombre;
            $graduado->dni = $graduadoParaRegistroDTO->dni;
            $graduado->fecha_nacimiento = $graduadoParaRegistroDTO->fecha_nacimiento;
            $graduado->contacto = $graduadoParaRegistroDTO->contacto;
            $graduado->ocupacion_trabajo = $graduadoParaRegistroDTO->ocupacion_trabajo;
            $graduado->ocupacion_empresa = $graduadoParaRegistroDTO->ocupacion_empresa;
            $graduado->ocupacion_sector = $graduadoParaRegistroDTO->ocupacion_sector;
            $graduado->ocupacion_informacion_adicional = $graduadoParaRegistroDTO->ocupacion_informacion_adicional;
            $graduado->experiencia_anios = $graduadoParaRegistroDTO->experiencia_anios;
            $graduado->habilidades_competencias = $graduadoParaRegistroDTO->habilidades_competencias;
            $graduado->cv = $graduadoParaRegistroDTO->cv;
            $graduado->interes_comunidad = $graduadoParaRegistroDTO->interes_comunidad;
            $graduado->interes_oferta = $graduadoParaRegistroDTO->interes_oferta;
            $graduado->interes_demanda = $graduadoParaRegistroDTO->interes_demanda;

            $ciudadDTO = new CiudadDeGraduadoParaRegistroDTO(
                $graduadoParaRegistroDTO->ciudad['nombre'],
                $graduadoParaRegistroDTO->ciudad['latitud'],
                $graduadoParaRegistroDTO->ciudad['longitud']
            );

            $ciudad = Ciudad::where('nombre', $ciudadDTO->nombre)->first();
            if (!$ciudad) {
                $ciudad = Ciudad::create([
                    'nombre' => $ciudadDTO->nombre,
                    'latitud' => $ciudadDTO->latitud,
                    'longitud' => $ciudadDTO->longitud
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
            DB::commit();
            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => 'Hubo un error al registrar el graduado: ' . $e->getMessage()
            ];
        }
    }

    public function obtenerGraduadosPorValidar()
    {
        $graduados = Graduado::where('validado', 'false')->with(['carreras.departamento'])->get();

        $graduadosDTOs = $graduados->map(function ($graduado) {
            return new GraduadoPorValidarDTO(
                $graduado->id,
                $graduado->nombre,
                $graduado->dni,
                $graduado->fecha_nacimiento,
                $this->formatearCarreras($graduado->carreras),
                $graduado->interes_comunidad,
                $graduado->interes_oferta,
                $graduado->interes_demanda,
                $this->formatearTrabajo($graduado->ocupacion_trabajo),
                $graduado->ocupacion_empresa,
                $this->formatearSectorTrabajo($graduado->ocupacion_sector),
                $graduado->ocupacion_informacion_adicional,
                $this->formatearExperiencia($graduado->experiencia_anios),
                $graduado->habilidades_competencias,
            );
        });

        $result = $graduadosDTOs->toArray();

        return $result;
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
            case 'menos_2':
                return 'Menos de 2 años';
            case 'de_2_a_5':
                return 'De 2 a 5 años';
            case 'de_5_a_10':
                return 'De 5 a 10 años';
            case 'mas_10':
                return 'Más de 10 años';
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