<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Receta; // Importar el modelo Receta

class RecetaController extends Controller
{
    // Muestra todas las recetas
    public function index(){
        // return Receta::all(); // Devuelve todas las recetas
        return Receta::with('categoria', 'etiquetas', 'user')->get(); // Carga las relaciones categoria, etiquetas y user
    }

    // Muestra una receta a partir de su id
    public function show(Receta $receta){
        // return $receta; // Devuelve la receta
        return $receta->load('categoria', 'etiquetas', 'user'); // Carga las relaciones categoria, etiquetas y user
    }
}
