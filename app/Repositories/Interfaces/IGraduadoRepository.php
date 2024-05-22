<?php

namespace App\Repositories\Interfaces;

interface IGraduadoRepository
{
    public function obtenerGraduadosConFiltros();
    public function registrarGraduado(array $infoGraduado);
}