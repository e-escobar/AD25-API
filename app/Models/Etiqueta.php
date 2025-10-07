<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    /** @use HasFactory<\Database\Factories\EtiquetaFactory> */
    use HasFactory;

    // Relación 1:N (Una etiqueta tiene muchas recetas)
    public function recetas(){
        return $this->belongsToMany(Receta::class);
    }
}
