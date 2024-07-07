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

    /**
     * @OA\Get(
     *     path="/api/carreras",
     *     summary="Obtener todas las carreras",
     *     tags={"Mapa"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todas las carreras",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nombre", type="string"),
     *                 @OA\Property(property="descripcion", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerTodasLasCarreras(Request $request)
    {
        $carreras = $this->carreraRepository->obtenerTodasLasCarreras();
        return response()->json($carreras);
    }
}
