<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RecetaResource;  // Importar el recurso RecetasResource
use App\Http\Requests\StoreRecetasRequest;  // Importar la request StoreRecetasRequest
use App\Http\Requests\UpdateRecetasRequest; // Importar la request UpdateRecetasRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTP

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait AuthorizesRequests para la autorización de políticas


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Receta; // Importar el modelo Receta

class RecetaController extends Controller
{
    use AuthorizesRequests; // Usar el trait AuthorizesRequests para la autorización de políticas

    // Muestra todas las recetas
    public function index(){
        $this->authorize('Ver recetas');  
        $recetas = Receta::with('categoria', 'etiquetas', 'user')->get();
        return RecetaResource::collection($recetas); // Devuelve todas las recetas como recurso API
    }

    // Muestra una receta a partir de su id
    public function show(Receta $receta){
        $this->authorize('Ver recetas');  
        $receta = $receta->load('categoria', 'etiquetas', 'user');
        return new RecetaResource($receta); // Devuelve la receta como recurso API 
    }

    // Almacena una nueva receta 
    public function store(StoreRecetasRequest $request){  // Usar la request StoreRecetasRequest para validar los datos
        $this->authorize('Crear recetas');  
       
        $receta = $request->user()->recetas()->create($request->all());  // Crear una nueva receta asociada al usuario autenticado
        $receta->etiquetas()->attach(json_decode($request->etiquetas));  // Asociar las etiquetas a la receta (decodificar el JSON recibido)

        $receta->imagen = $request->file('imagen')->store('recetas','public'); // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
        $receta->save(); // Guardar la receta con la ruta de la imagen
 
        // Devolver la receta creada como recurso API con código de estado 201 (creado) 
        return response()->json(new RecetaResource($receta), Response::HTTP_CREATED); 
    }

    // Actualiza una receta existente
    public function update(UpdateRecetasRequest $request, Receta $receta){  // Usar la request UpdateRecetasRequest para validar los datos
        $this->authorize('Editar recetas');

        $this->authorize('update', $receta);  // Autorizar la acción usando la política RecetaPolicy
        
        $receta->update($request->all());  // Actualizar la receta con los datos validados

        if($etiquetas = json_decode($request->etiquetas)){  // Si se reciben etiquetas, decodificar el JSON
            $receta->etiquetas()->sync($etiquetas);  // Sincronizar las etiquetas (eliminar las que no están y agregar las nuevas)
        }

        if($request->file('imagen')){  // Si se recibe una imagen
            $receta->imagen = $request->file('imagen')->store('recetas','public');  // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
            $receta->save(); // Guardar la receta con la ruta de la imagen
        }


        // Devolver la receta actualizada como recurso API con código de estado 200 (OK)
        return response()->json(new RecetaResource($receta), Response::HTTP_OK);
    }

    // Elimina una receta existente
    public function destroy(Receta $receta){  // Inyectar la receta a eliminar
        $this->authorize('Eliminar recetas');
        
        $this->authorize('delete', $receta);  // Autorizar la acción usando la política RecetaPolicy
        
        $receta->delete();  // Eliminar la receta

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
