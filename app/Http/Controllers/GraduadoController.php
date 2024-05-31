<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Interfaces\IGraduadoRepository;
use App\DTO\GraduadoParaRegistroDTO;

class GraduadoController extends Controller
{
    private IGraduadoRepository $graduadoRepository;

    public function __construct(IGraduadoRepository $graduadoRepository)
    {
        $this->graduadoRepository = $graduadoRepository;
    }

    public function obtenerGraduadosConFiltros(Request $request)
    {
        $filters = $request->only(['nombre', 'anio', 'titulo', 'departamento']);
        $graduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters);
        return response()->json($graduados);
    }

    public function registrarNuevoGraduado(Request $request)
    {
        $validado = $request->validate([
            'nombre' => 'required|string',
            'dni' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'ciudad_id' => 'required|integer',
            'contacto' => 'required|string',
            'carreras' => 'nullable|array',
            'carreras.*.carrera_id' => 'required_with:carreras|integer',
            'carreras.*.anio_graduacion' => 'required_with:carreras|string',
            'ocupacion_trabajo' => 'nullable|string',
            'ocupacion_empresa' => 'nullable|string',
            'ocupacion_sector' => 'nullable|string',
            'ocupacion_informacion_adicional' => 'nullable|string',
            'experiencia_anios' => 'nullable|string',
            'experiencia_informacion_adicional' => 'nullable|string',
            'habilidades_competencias' => 'nullable|string',
            'formacion' => 'nullable|array',
            'formacion.*.titulo' => 'required_with:formacion|string',
            'formacion.*.institucion' => 'required_with:formacion|string',
            'formacion.*.nivel' => 'required_with:formacion|string',
            'rrss' => 'nullable|array',
            'rrss.*.rrss' => 'required_with:rrss|string',
            'rrss.*.url' => 'required_with:rrss|url',
            'cv' => 'nullable|string',
            'interes_comunidad' => 'required|boolean',
            'interes_oferta' => 'required|boolean',
            'interes_demanda' => 'required|boolean',
        ]);

        $graduadoDTO = new GraduadoParaRegistroDTO(
            $validado['nombre'],
            $validado['dni'],
            $validado['fecha_nacimiento'],
            $validado['ciudad_id'],
            $validado['contacto'],
            $validado['carreras'] ?? [],
            $validado['interes_comunidad'],
            $validado['interes_oferta'],
            $validado['interes_demanda'],
            $validado['ocupacion_trabajo'] ?? null,
            $validado['ocupacion_empresa'] ?? null,
            $validado['ocupacion_sector'] ?? null,
            $validado['ocupacion_informacion_adicional'] ?? null,
            $validado['experiencia_anios'] ?? null,
            $validado['experiencia_informacion_adicional'] ?? null,
            $validado['habilidades_competencias'] ?? null,
            $validado['formacion'] ?? [],
            $validado['rrss'] ?? [],
            $validado['cv'] ?? null,
        );

        $result = $this->graduadoRepository->registrarGraduado($graduadoDTO);

        if (isset($result['error'])) {
            return response()->json([
                'error' => $result['error']
            ], 400);
        }
        return response()->json([
            'message' => 'Graduado registrado exitosamente',
        ], 201);
    }


    public function obtenerGraduadosPorValidar(Request $request){
        $graduados = $this->graduadoRepository->obtenerGraduadosPorValidar();
        return response()->json($graduados);
    }

    public function validarGraduado($id){
        $resultado = $this->graduadoRepository->validarGraduado($id);

        if (isset($resultado['error'])) {
            return response()->json(['error' => $resultado['error']], 400);
        }

        return response()->json(['success' => true], 200);
    }
}
