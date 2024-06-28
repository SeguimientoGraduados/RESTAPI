<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Interfaces\ICiudadRepository;

class CiudadController extends Controller
{
    private ICiudadRepository $ciudadRepository;

    public function __construct(ICiudadRepository $ciudadRepository) 
    {
        $this->ciudadRepository = $ciudadRepository;
    }

    public function obtenerTodasLasCiudades(Request $request){
        $ciudades = $this->ciudadRepository->obtenerTodasLasCiudades();
        return response()->json($ciudades);
    }
}
