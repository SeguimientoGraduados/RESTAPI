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

    /**
     * @OA\Get(
     *     path="/api/ciudades",
     *     summary="Obtener todas las ciudades",
     *     tags={"Mapa"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todas las ciudades",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="nombre", type="string"),
     *                 @OA\Property(property="pais", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerTodasLasCiudades(Request $request)
    {
        $ciudades = $this->ciudadRepository->obtenerTodasLasCiudades();
        return response()->json($ciudades);
    }
}
