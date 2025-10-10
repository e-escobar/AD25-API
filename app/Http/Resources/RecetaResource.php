<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [  // Estructuramos la respuesta de la receta como recurso API
            'id' => $this->id,
            'tipo' => 'receta',
            'atributos' => [
                'categoria' => $this->categoria->nombre,  // Nombre de la categoria asociada a la receta
                'autor' => $this->user->name,  // Nombre del autor (usuario) de la receta
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion,
                'ingredientes' => $this->ingredientes,
                'instrucciones' => $this->instrucciones,
                'imagen' => $this->imagen,
                'etiquetas' => $this->etiquetas->pluck('nombre')->implode(', '),  // Lista de nombres de etiquetas asociadas a la receta separadas por comas 
                // pluck extrae los nombres de las etiquetas y implode los une en una cadena separada por comas
            ],
        ];  
    }
}
