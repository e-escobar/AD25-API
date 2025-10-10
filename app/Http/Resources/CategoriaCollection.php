<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($categoria) {  // Mapear cada categoria en la colección y estructurarla
            return [
                'id' => $categoria->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $categoria->nombre,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    }
}
