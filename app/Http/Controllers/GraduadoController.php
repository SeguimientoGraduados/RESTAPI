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
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Graduado;
use App\Models\User;
use App\Imports\GraduadosImport;
use Symfony\Component\HttpFoundation\StreamedResponse;


class GraduadoController extends Controller
{
    private IGraduadoRepository $graduadoRepository;

    public function __construct(IGraduadoRepository $graduadoRepository)
    {
        $this->graduadoRepository = $graduadoRepository;
    }

    /**
     * @OA\Get(
     *     path="/rest/graduados/filtros",
     *     summary="Obtener graduados con filtros",
     *     tags={"Filtros"},
     *     @OA\Parameter(
     *         name="filtro",
     *         in="query",
     *         description="Filtro para buscar graduados",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de graduados filtrados",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerGraduadosConFiltros(Request $request)
    {
        $filters = $this->getRequestFilters($request);

        $isAdmin = false;

        $user = $request->user();

        if ($user && $user->rol == User::ROL_ADMIN) {
            $isAdmin = true;
        }

        $graduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters, $isAdmin);
        return response()->json($graduados);
    }

    /**
     * @OA\Get(
     *     path="/rest/graduados/perfil",
     *     summary="Obtener datos personales del graduado autenticado",
     *     tags={"Registro Graduado"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Datos personales del graduado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nombre", type="string", example="John"),
     *             @OA\Property(property="apellido", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="carrera", type="string", example="Ingeniería en Sistemas"),
     *             @OA\Property(property="anio_graduacion", type="integer", example=2020),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Graduado no registrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Graduado no registrado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerDatosPersonales(Request $request)
    {
        $usuario = Auth::user();
        if ($usuario) {
            try {
                $datos = $this->graduadoRepository->obtenerGraduado($usuario->email);
                return response()->json($datos);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Graduado no encontrado'], 404);
            }
        } else {
            return response()->json(['message' => 'Graduado no registrado'], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/rest/graduados",
     *     summary="Registrar un nuevo graduado",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="apellido", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="carrera", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Graduado registrado exitosamente",
     *         @OA\JsonContent(type="object", @OA\Property(property="message", type="string"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/rest/graduados",
     *     summary="Actualizar datos del graduado",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="contacto", type="string", example="johndoe@example.com"),
     *                 @OA\Property(property="nombre", type="string", example="John"),
     *                 @OA\Property(property="apellido", type="string", example="Doe"),
     *                 @OA\Property(property="direccion", type="string", example="123 Main St"),
     *                 @OA\Property(property="ciudad", type="string", example="Springfield"),
     *                 @OA\Property(property="pais", type="string", example="USA"),
     *                 @OA\Property(property="telefono", type="string", example="+1234567890"),
     *                 @OA\Property(property="fecha_graduacion", type="string", format="date", example="2020-05-15"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Graduado actualizado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Graduado actualizado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la actualización",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Error message")
     *         )
     *     )
     * )
     */
    public function actualizarDatosGraduado(Request $request)
    {
        $graduado = Graduado::where('contacto', $request->input('contacto'))->first();

        $validado = $this->validateGraduado($request, $graduado->id);

        $graduadoDTO = $this->createGraduadoDTO($validado);
        $result = $this->graduadoRepository->actualizarGraduado($graduadoDTO);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        return response()->json(['message' => 'Graduado actualizado exitosamente'], 201);
    }

    /**
     * @OA\Get(
     *     path="/rest/graduados/validar",
     *     summary="Obtener graduados pendientes de validación",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de graduados por validar",
     *         @OA\JsonContent(type="array", @OA\Items(type="object"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerGraduadosPorValidar(Request $request)
    {
        $cantPagina = 10;
        $graduados = $this->graduadoRepository->obtenerGraduadosPorValidar($cantPagina);
        return response()->json($graduados);
    }

    /**
     * @OA\Patch(
     *     path="/rest/graduados/validar/aprobar/{id}",
     *     summary="Aprobar un graduado",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del graduado a aprobar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Graduado aprobado",
     *         @OA\JsonContent(type="object", @OA\Property(property="message", type="string"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Graduado no encontrado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function aprobarGraduado($id)
    {
        return $this->cambiarEstadoGraduado($id, 'aprobarGraduado', 'solicitudAceptada');
    }

    /**
     * @OA\Delete(
     *     path="/rest/graduados/validar/rechazar/{id}",
     *     summary="Rechazar un graduado",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del graduado a rechazar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Graduado rechazado",
     *         @OA\JsonContent(type="object", @OA\Property(property="message", type="string"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Graduado no encontrado",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function rechazarGraduado($id)
    {
        return $this->cambiarEstadoGraduado($id, 'rechazarGraduado', 'solicitudRechazada');
    }

    /**
     * @OA\Get(
     *     path="/rest/graduados/enumerados",
     *     summary="Obtener enumerados",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\Response(
     *         response=200,
     *         description="Listado de enumerados",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="ocupacion_trabajo",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="value", type="string", example="rel_dependencia"),
     *                     @OA\Property(property="label", type="string", example="Relación de dependencia")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="ocupacion_sector",
     *                 type="array",
     *                 @OA\Items(type="string", example="Privado")
     *             ),
     *             @OA\Property(
     *                 property="exp_anios",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="value", type="string", example="menos_5"),
     *                     @OA\Property(property="label", type="string", example="Menos de 5 años")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="rrss",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="value", type="string", example="linkedin"),
     *                     @OA\Property(property="label", type="string", example="LinkedIn")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="nivel_formacion",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="value", type="string", example="secundario"),
     *                     @OA\Property(property="label", type="string", example="Secundario")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/rest/graduados/exportar-excel",
     *     summary="Exportar graduados filtrados a Excel",
     *     security={{ "bearer_token": {} }},
     *     tags={"Registro Graduado"},
     *     @OA\Parameter(
     *         name="pais",
     *         in="query",
     *         description="ID del país para filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="ciudad",
     *         in="query",
     *         description="ID de la ciudad para filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="departamento",
     *         in="query",
     *         description="ID del departamento para filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="carrera",
     *         in="query",
     *         description="ID de la carrera para filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="anioDesde",
     *         in="query",
     *         description="Año desde el cual filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="anioHasta",
     *         in="query",
     *         description="Año hasta el cual filtrar",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Archivo CSV de graduados filtrados",
     *         @OA\MediaType(
     *             mediaType="text/csv",
     *             @OA\Schema(type="string", format="binary")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud incorrecta"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function obtenerGraduadosPorFiltroExportarExcel(Request $request)
    {
        $filters = $this->getRequestFilters($request);
        $ciudadesConGraduados = $this->graduadoRepository->obtenerGraduadosConFiltros($filters);

        $graduadosList = $this->crearListaGraduadosParaExcel($ciudadesConGraduados);

        $fileContent = Excel::raw(new GraduadosExport($graduadosList), \Maatwebsite\Excel\Excel::CSV);

        return new StreamedResponse(function () use ($fileContent) {
            echo $fileContent;
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="graduados.csv"',
        ]);

    }

    public function importarGraduadosCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        try {
            Excel::import(new GraduadosImport, $request->file('file'));
            return response()->json(['message' => 'Archivo importado exitosamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getRequestFilters(Request $request)
    {
        return $request->only(['ciudad', 'pais', 'departamento', 'carrera', 'anioDesde', 'anioHasta', 'interes_comunidad', 'interes_oferta', 'interes_demanda']);
    }

    private function validateGraduado(Request $request, $graduadoId = null)
    {
        return $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'apellido' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'contacto' => [
                'required',
                'email',
                Rule::unique('graduados', 'contacto')->ignore($graduadoId)
            ],
            'dni' => [
                'required',
                'digits_between:6,9',
                Rule::unique('graduados', 'dni')->ignore($graduadoId)
            ],
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
            'visibilidad_contacto' => 'required|boolean',
            'visibilidad_laboral' => 'required|boolean',
            'visibilidad_formacion' => 'required|boolean',
        ]);
    }

    private function createGraduadoDTO(array $validado)
    {
        return new GraduadoParaRegistroDTO(
            $validado['nombre'],
            $validado['apellido'],
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
            $validado['visibilidad_contacto'] ?? null,
            $validado['visibilidad_laboral'] ?? null,
            $validado['visibilidad_formacion'] ?? null,
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
                    $graduado->email
                );

                $graduadosList[] = $graduadoDTO;
            }
        }

        return $graduadosList;
    }
}