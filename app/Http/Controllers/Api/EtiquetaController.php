<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EtiquetaResource;  // Importar el recurso EtiquetaResource

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Etiqueta; // Importar el modelo Etiqueta

class EtiquetaController extends Controller
{
    // Muestra todas las etiquetas
    public function index(){
        // return Etiqueta::all(); // Devuelve todas las etiquetas
        // return Etiqueta::with('recetas')->get(); // Carga las recetas asociadas a la etiqueta
        return EtiquetaResource::collection(Etiqueta::with('recetas')->get()); // Devuelve todas las etiquetas como recurso API
    }

    // Muestra una etiqueta a partir de su id
    public function show(Etiqueta $etiqueta){ 
        // return $etiqueta; // Devuelve la etiqueta
        // return $etiqueta->load('recetas'); // Carga las recetas asociadas a la etiqueta
        return new EtiquetaResource($etiqueta->load('recetas')); // Devuelve la etiqueta como recurso API 
    }
}
