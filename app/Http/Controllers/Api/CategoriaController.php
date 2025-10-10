<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriaResource; // Importar el recurso CategoriaResource 
use App\Http\Resources\CategoriaCollection;  // Importar el recurso CategoriaCollection

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria; // Importar el modelo Categoria

class CategoriaController extends Controller
{
    // Muestra todas las categorias
    public function index(){
        // return Categoria::all(); // Devuelve todas las categorias
        return new CategoriaCollection(Categoria::all());  // Devuelve todas las categorias como recurso API
    }

    // Muestra una categoria a partir de su id
    public function show(Categoria $categoria){
        // return $categoria; // Devuelve la categoria
        $categoria = $categoria->load('recetas');  // Carga las recetas relacionadas con la categoria
        return new CategoriaResource($categoria);  // Devuelve la categoria como recurso API 
    }


}
