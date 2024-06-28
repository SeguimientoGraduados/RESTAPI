<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICarreraRepository;

class CarreraController extends Controller
{
    private ICarreraRepository $carreraRepository;

    public function __construct(ICarreraRepository $carreraRepository)
    {
        $this->carreraRepository = $carreraRepository;
    }

    public function obtenerTodasLasCarreras(Request $request)
    {
        $carreras = $this->carreraRepository->obtenerTodasLasCarreras();
        return response()->json($carreras);
    }
}
