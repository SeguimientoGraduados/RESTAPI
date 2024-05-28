<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IGraduadoRepository;
use App\Models\Graduado;
use App\DTO\GraduadoParaMapaDTO;
use App\DTO\CarreraDeGraduadoParaMapaDTO;


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
                    $this->formatearCarreras($graduado->carreras->toArray()),
                    $graduado->contacto,
                    $graduado->ocupacion_trabajo,
                    $graduado->ocupacion_empresa,
                    $graduado->ocupacion_sector,
                    $graduado->ocupacion_informacion_adicional,
                    $this->formatearExperiencia($graduado->experiencia_anios),
                    $graduado->experiencia_informacion_adicional,
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

    public function registrarGraduado(array $infoGraduado)
    {

    }

    private function formatearCarreras(array $carreras): array {
        return array_map(function ($carrera) {
            return new CarreraDeGraduadoParaMapaDTO(
                $carrera['id'],
                $carrera['nombre'],
                $carrera['departamento']['nombre']
            );
        }, $carreras);
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
}