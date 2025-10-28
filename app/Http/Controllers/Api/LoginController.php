<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;  // Para verificar contraseñas
use Symfony\Component\HttpFoundation\Response;  // Para usar códigos de estado HTTP
use App\Models\User;  // Importar el modelo User

class LoginController extends Controller
{
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
