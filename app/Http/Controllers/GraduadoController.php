<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Interfaces\IGraduadoRepository;

class GraduadoController extends Controller
{
    private IGraduadoRepository $graduadoRepository;

    public function __construct(IGraduadoRepository $graduadoRepository) 
    {
        $this->graduadoRepository = $graduadoRepository;
    }

    public function obtenerGraduadosConFiltros(Request $request){
        $filters = $request->only(['nombre', 'anio', 'titulo','departamento']);
        $graduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters);
        return response()->json($graduados);
    }
}
