<?php

namespace App\Repositories\Interfaces;
use App\DTO\GraduadoParaRegistroDTO;


interface IGraduadoRepository
{
    public function obtenerGraduadosConFiltros(array $filters);
    public function registrarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO);
    public function obtenerGraduadosPorValidar();
    public function validarGraduado($graduado_id);
}