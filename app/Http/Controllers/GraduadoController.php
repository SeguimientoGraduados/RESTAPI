<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'ciudad' => 'required|array',
            'contacto' => 'required|string',
            'carreras' => 'nullable|array',
            'carreras.*.carrera_id' => 'required_with:carreras|integer',
            'carreras.*.anio_graduacion' => 'required_with:carreras|string',
            'ocupacion_trabajo' => 'nullable|string',
            'ocupacion_empresa' => 'nullable|string',
            'ocupacion_sector' => 'nullable|string',
            'ocupacion_informacion_adicional' => 'nullable|string',
            'experiencia_anios' => 'nullable|string',
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
            $validado['ciudad'],
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


    public function obtenerGraduadosPorValidar(Request $request)
    {
        $graduados = $this->graduadoRepository->obtenerGraduadosPorValidar();
        return response()->json($graduados);
    }

    public function aprobarGraduado($id)
    {
        $resultado = $this->graduadoRepository->aprobarGraduado($id);

        if (isset($resultado['error'])) {
            return response()->json(['error' => $resultado['error']], 400);
        }

        return response()->json(['success' => true], 200);
    }

    public function rechazarGraduado($id)
    {
        $resultado = $this->graduadoRepository->rechazarGraduado($id);

        if (isset($resultado['error'])) {
            return response()->json(['error' => $resultado['error']], 400);
        }

        return response()->json(['success' => true], 200);
    }

    public function obtenerEnumerados()
    {
        $ocupacion_trabajo = [
            ['value' => 'rel_dependencia', 'label' => 'Relación de dependencia'],
            ['value' => 'autonomo', 'label' => 'Autónomo']
        ];
        $ocupacion_sector = [
            'Privado',
            'Público'
        ];
        $exp_anios = [
            ['value' => 'menos_2', 'label' => 'Menos de 2 años'],
            ['value' => 'de_2_a_5', 'label' => 'De 2 a 5 años'],
            ['value' => 'de_5_a_10', 'label' => 'De 5 a 10 años'],
            ['value' => 'mas_10', 'label' => 'Más de 10 años']
        ];
        $rrss = [
            ['value' => 'linkedin', 'label' => 'LinkedIn'],
            ['value' => 'twitter', 'label' => 'Twitter'],
            ['value' => 'facebook', 'label' => 'Facebook']
        ];
        $nivel_formacion = [
            ['value' => 'secundario', 'label' => 'Secundario'],
            ['value' => 'terciario', 'label' => 'Terciario'],
            ['value' => 'universitario', 'label' => 'Universitario'],
            ['value' => 'otro', 'label' => 'Otro']
        ];

        $enumerados = [
            'ocupacion_trabajo' => $ocupacion_trabajo,
            'ocupacion_sector' => $ocupacion_sector,
            'exp_anios' => $exp_anios,
            'rrss' => $rrss,
            'nivel_formacion' => $nivel_formacion,
        ];

        return json_encode($enumerados, JSON_UNESCAPED_UNICODE);
    }
}
