<?php

namespace App\Repositories\Interfaces;
use App\DTO\GraduadoParaRegistroDTO;


interface IGraduadoRepository
{
    public function obtenerGraduadosConFiltros(array $filters, ?bool $isAdmin = null);
    public function obtenerGraduado(string $email);
    public function registrarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO);
    public function actualizarGraduado(GraduadoParaRegistroDTO $graduadoParaRegistroDTO);
    public function obtenerGraduadosPorValidar($cantPagina);
    public function aprobarGraduado($id);
    public function rechazarGraduado($id);
    public function obtenerValoresParaFiltrar($filters);
    public function obtenerEmailGraduado($id);

}