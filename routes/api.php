<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importar controladores
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\RecetaController;
use App\Http\Controllers\Api\EtiquetaController;

// Rutas de categorias 
Route::apiResource('categorias', CategoriaController::class);

// Rutas de recetas
Route::apiResource('recetas', RecetaController::class);

// Rutas de etiquetas
Route::apiResource('etiquetas', EtiquetaController::class);


    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');
