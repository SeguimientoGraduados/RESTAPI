<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IGraduadoRepository;
use App\DTO\GraduadoParaRegistroDTO;
use App\DTO\GraduadoParaExcelDTO;
use Mail;
use App\Mail\SolicitudesCorreo;
use App\Exports\GraduadosExport;
use Maatwebsite\Excel\Facades\Excel;

class GraduadoController extends Controller
{
    private IGraduadoRepository $graduadoRepository;

    public function __construct(IGraduadoRepository $graduadoRepository)
    {
        $this->graduadoRepository = $graduadoRepository;
    }

    public function obtenerGraduadosConFiltros(Request $request)
    {
        $filters = $this->getRequestFilters($request);
        $graduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters);
        return response()->json($graduados);
    }

    public function registrarNuevoGraduado(Request $request)
    {
        $validado = $this->validateGraduado($request);

        $graduadoDTO = $this->createGraduadoDTO($validado);
        $result = $this->graduadoRepository->registrarGraduado($graduadoDTO);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        return response()->json(['message' => 'Graduado registrado exitosamente'], 201);
    }

    public function obtenerGraduadosPorValidar(Request $request)
    {
        $cantPagina = 10;
        $graduados = $this->graduadoRepository->obtenerGraduadosPorValidar($cantPagina);
        return response()->json($graduados);
    }

    public function aprobarGraduado($id)
    {
        return $this->cambiarEstadoGraduado($id, 'aprobarGraduado', 'solicitudAceptada');
    }

    public function rechazarGraduado($id)
    {
        return $this->cambiarEstadoGraduado($id, 'rechazarGraduado', 'solicitudRechazada');
    }

    public function obtenerEnumerados()
    {
        $enumerados = [
            'ocupacion_trabajo' => [
                ['value' => 'rel_dependencia', 'label' => 'Relación de dependencia'],
                ['value' => 'autonomo', 'label' => 'Autónomo']
            ],
            'ocupacion_sector' => ['Privado', 'Público'],
            'exp_anios' => [
                ['value' => 'menos_5', 'label' => 'Menos de 5 años'],
                ['value' => 'de_5_a_10', 'label' => 'De 5 a 10 años'],
                ['value' => 'de_10_a_20', 'label' => 'De 10 a 20 años'],
                ['value' => 'mas_20', 'label' => 'Más de 20 años']
            ],
            'rrss' => [
                ['value' => 'linkedin', 'label' => 'LinkedIn'],
                ['value' => 'twitter', 'label' => 'Twitter'],
                ['value' => 'facebook', 'label' => 'Facebook']
            ],
            'nivel_formacion' => [
                ['value' => 'secundario', 'label' => 'Secundario'],
                ['value' => 'terciario', 'label' => 'Terciario'],
                ['value' => 'universitario', 'label' => 'Universitario'],
                ['value' => 'otro', 'label' => 'Otro']
            ]
        ];

        return json_encode($enumerados, JSON_UNESCAPED_UNICODE);
    }

    public function obtenerValoresParaFiltrar(Request $request)
    {
        $filters = $this->getRequestFilters($request);
        $valores = $this->graduadoRepository->obtenerValoresParaFiltrar($filters);
        return response()->json($valores);
    }

    public function obtenerGraduadosPorFiltroExportarExcel(Request $request)
    {
        $filters = $this->getRequestFilters($request);
        $ciudadesConGraduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters);

        $graduadosList = $this->crearListaGraduadosParaExcel($ciudadesConGraduados);

        return Excel::download(new GraduadosExport($graduadosList), 'graduados.xlsx');
    }

    private function getRequestFilters(Request $request)
    {
        return $request->only(['ciudad', 'pais', 'departamento', 'carrera', 'anioDesde', 'anioHasta', 'interes_comunidad', 'interes_oferta', 'interes_demanda']);
    }

    private function validateGraduado(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'contacto' => 'required|email|unique:graduados,contacto',
            'dni' => 'required|digits_between:6,9|unique:graduados,dni',
            'fecha_nacimiento' => 'required|date|before:2005-01-01',
            'carreras' => 'required|array',
            'carreras.*.carrera_id' => 'required_with:carreras|integer|exists:carreras,id',
            'carreras.*.anio_graduacion' => 'required_with:carreras|digits:4',
            'ciudad' => 'required|array',
            'ciudad.nombre' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'ciudad.latitud' => 'required|numeric|between:-90.0,90.0',
            'ciudad.longitud' => 'required|numeric|between:-90.0,90.0',
            'ciudad.pais' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'rrss' => 'nullable|array',
            'rrss.*.rrss' => 'required_with:rrss|string',
            'rrss.*.url' => 'required_with:rrss|url',
            'ocupacion_trabajo' => 'nullable|string',
            'ocupacion_empresa' => 'nullable|string',
            'ocupacion_sector' => 'nullable|string',
            'ocupacion_informacion_adicional' => 'nullable|string|max:500',
            'experiencia_anios' => 'nullable|string',
            'habilidades_competencias' => 'nullable|string',
            'formacion' => 'nullable|array',
            'formacion.*.titulo' => 'required_with:formacion|string',
            'formacion.*.institucion' => 'required_with:formacion|string',
            'formacion.*.nivel' => 'required_with:formacion|string',
            'cv' => 'nullable|string',
            'interes_comunidad' => 'required|boolean',
            'interes_oferta' => 'required|boolean',
            'interes_demanda' => 'required|boolean',
        ]);
    }

    private function createGraduadoDTO(array $validado)
    {
        return new GraduadoParaRegistroDTO(
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
    }

    private function cambiarEstadoGraduado($id, $metodo, $plantillaCorreo)
    {
        $resultado = $this->graduadoRepository->$metodo($id);
        $graduadoMail = $this->graduadoRepository->obtenerEmailGraduado($id);

        if (isset($resultado['error'])) {
            return response()->json(['error' => $resultado['error']], 400);
        }

        Mail::to($graduadoMail)->send(new SolicitudesCorreo("mails.$plantillaCorreo"));
        return response()->json(['success' => true], 200);
    }

    private function crearListaGraduadosParaExcel(array $ciudadesConGraduados)
    {
        $graduadosList = [];

        foreach ($ciudadesConGraduados as $ciudadData) {
            $ciudad = $ciudadData['ciudad'];
            $graduados = $ciudad['graduados'];

            foreach ($graduados as $graduado) {
                $graduadoDTO = new GraduadoParaExcelDTO(
                    $graduado->nombre,
                    $graduado->email
                );

                $graduadosList[] = $graduadoDTO;
            }
        }

        return $graduadosList;
    }
}