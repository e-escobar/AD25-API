<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;  // Para verificar contraseñas
use Symfony\Component\HttpFoundation\Response;  // Para usar códigos de estado HTTP
use App\Models\User;  // Importar el modelo User

class LoginController extends Controller
{

    // Post con swagger para login
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Iniciar sesión de usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"correo","contraseña","dispositivo"},
     *             @OA\Property(property="correo", type="string", format="email", example="eescobar@laravel.com"),
     *            @OA\Property(property="contraseña", type="string", format="password", example="password"),
     *            @OA\Property(property="dispositivo", type="string", example="Mi dispositivo"),
     *        ),
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Inicio de sesión exitoso",
     *       @OA\JsonContent(
     *           @OA\Property(property="data", type="object",),
     *              @OA\Property(property="attributes", type="object",),
     *                 @OA\Property(property="id", type="integer", example=1),
     *                @OA\Property(property="nombre", type="string", example="Juan Pérez"),
     *               @OA\Property(property="correo", type="string", example=""),
     *           ),
     *              @OA\Property(property="token", type="string", example="token_de_acceso_aqui"),
     *       ),
     *   ),
     *   @OA\Response(
     *       response=422,
     *       description="Credenciales incorrectas",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Las credenciales son incorrectas."),
     *    ),
     * ),
     * )
     * 
     */ 

    
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
            'dispositivo' => 'required',
        ]);
   
        // Buscar el usuario por correo electrónico
        $user = User::where('email', $request->correo)->first();
   
        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || ! Hash::check($request->contraseña, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        // Generar un token de acceso para el usuario
        return response()->json([
            'data' => [
                'attributes' => [
                    'id' => $user->id,
                    'nombre' => $user->name,
                    'correo' => $user->email,
                ],
                'token' => $user->createToken($request->dispositivo)->plainTextToken,
            ],
        ],Response::HTTP_OK); // 200
    }

    public function destroy(Request $request)
    {
        // Revocar el token de acceso del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso.',
        ], Response::HTTP_OK); // 200
    }

}
