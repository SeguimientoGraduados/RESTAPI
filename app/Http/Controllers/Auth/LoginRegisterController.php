<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Graduado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginRegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Registrar un nuevo usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="password123")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario registrado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User is created successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="token", type="string"),
     *                 @OA\Property(property="user", type="object")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Validation Error!"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|' //min:8|confirmed
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $captchaValid = $this->validateRecaptcha($request->captchaToken);

        if (!$captchaValid) {
            return response()->json(['message' => 'Invalid CAPTCHA'], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => User::ROL_USER
        ]);

        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'rol' => $user->rol
        ];
        $data['graduado'] = false;

        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Autenticar usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="password123")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario autenticado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User is logged in successfully."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="token", type="string"),
     *                 @OA\Property(property="user", type="object")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Validation Error!"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="User does not exist")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Contraseña incorrecta",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Incorrect password")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'captchaToken' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        
        $captchaValid = $this->validateRecaptcha($request->captchaToken);

        if (!$captchaValid) {
            return response()->json(['message' => 'Invalid CAPTCHA'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $graduado = Graduado::where('contacto', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User does not exist'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Incorrect password'
            ], 401);
        }

        if ($user->rol == User::ROL_ADMIN) {
            $data['token'] = $user->createToken($request->email, ['admin'])->plainTextToken;
        } else {
            $data['token'] = $user->createToken($request->email)->plainTextToken;
        }

        $data['user'] = $user;

        if (!$graduado) {
            $data['graduado'] = false;
        } else {
            $data['graduado'] = true;
        }

        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }

    public function validateRecaptcha($token)
    {

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('APP_PUBLIC_SECRET_KEY'),
            'response' => $token
        ]);

        return $response->json()['success'];
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Cerrar sesión del usuario",
     *     security={{ "bearer_token": {} }},
     *     tags={"Autenticación"},
     *     @OA\Response(
     *         response=200,
     *         description="Usuario deslogueado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User is logged out successfully")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User is logged out successfully'
        ], 200);
    }
}