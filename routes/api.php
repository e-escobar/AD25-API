<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importar controladores
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\RecetaController;
use App\Http\Controllers\Api\EtiquetaController;

// Rutas de categorias 
Route::get('categorias', [CategoriaController::class, 'index']);
Route::get('categorias/{categoria}', [CategoriaController::class, 'show']);

// Rutas de recetas 
Route::get('recetas', [RecetaController::class, 'index']);
Route::get('recetas/{receta}', [RecetaController::class, 'show']);

// Rutas de etiquetas
Route::get('etiquetas', [EtiquetaController::class, 'index']);
Route::get('etiquetas/{etiqueta}', [EtiquetaController::class, 'show']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
