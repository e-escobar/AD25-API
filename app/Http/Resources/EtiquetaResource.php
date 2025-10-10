<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\RecetaResource; // Importar el recurso RecetasResource

class EtiquetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [  // Estructuramos la respuesta de la etiqueta como recurso API
            'id' => $this->id,
            'tipo' => 'etiqueta',
            'atributos' => [  // Estructuramos los atributos de la etiqueta
                'nombre' => $this->nombre
            ],
            'relaciones' => [  // Estructuramos las relaciones de la etiqueta
                //'recetas' => $this->recetas
                'recetas' => RecetaResource::collection($this->recetas)  // Usamos el recurso RecetasResource para formatear las recetas relacionadas
            ],
        ];

    }
}
