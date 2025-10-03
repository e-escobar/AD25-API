<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    /** @use HasFactory<\Database\Factories\RecetaFactory> */
    use HasFactory;

    // Una receta puede tener muchas etiquetas y una etiqueta puede tener muchas recetas
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }

}
