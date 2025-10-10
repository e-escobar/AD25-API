<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Etiqueta; // Importar el modelo Etiqueta

class EtiquetaController extends Controller
{
    // Muestra todas las etiquetas
    public function index(){
        // return Etiqueta::all(); // Devuelve todas las etiquetas
        return Etiqueta::with('recetas')->get(); // Carga las recetas asociadas a la etiqueta
    }

    // Muestra una etiqueta a partir de su id
    public function show(Etiqueta $etiqueta){ 
        // return $etiqueta; // Devuelve la etiqueta
        return $etiqueta->load('recetas'); // Carga las recetas asociadas a la etiqueta
    }
}
