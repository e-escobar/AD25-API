<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importar controladores
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\RecetaController;
use App\Http\Controllers\Api\EtiquetaController;
use App\Http\Controllers\Api\LoginController;

Route::post('login', [LoginController::class, 'store']);  // Ruta para el login

// Esto ayuda a evitar problemas de CORS en aplicaciones web que consumen esta API 
Route::options('{all:.*}', function(){
    return response()->json();
});

// Rutas protegidas por autenticación 
Route::middleware('auth:sanctum')->group(function () {  
    Route::apiResource('categorias', CategoriaController::class);  // Rutas de categorias
    Route::apiResource('recetas', RecetaController::class);  // Rutas de recetas
    Route::apiResource('etiquetas', EtiquetaController::class);  // Rutas de etiquetas
    Route::post('logout', [LoginController::class, 'destroy']);  // Ruta para el logout
});

