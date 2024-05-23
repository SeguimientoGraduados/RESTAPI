<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IGraduadoRepository;
use App\Models\Graduado;

class GraduadoRepository implements IGraduadoRepository 
{
    public function obtenerGraduadosConFiltros($filters = []){
        $query = Graduado::where('validado', true)->with('carreras');

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

        return $query->get();
    }

    public function registrarGraduado(array $infoGraduado){

    }
}