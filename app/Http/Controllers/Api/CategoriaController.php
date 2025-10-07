<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria; // Importar el modelo Categoria

class CategoriaController extends Controller
{
    // Muestra todas las categorias
    public function index(){
        return Categoria::all();
    }

    // Muestra una categoria a partir de su id
    public function show(Categoria $categoria){
        return $categoria; // Devuelve la categoria
        // return $categoria->load('recetas'); // Carga las recetas asociadas a la categoria
    }


}
