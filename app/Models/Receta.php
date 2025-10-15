<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    /** @use HasFactory<\Database\Factories\RecetaFactory> */
    use HasFactory;

    protected $fillable = [  // Campos que se pueden asignar masivamente 
        'categoria_id',
        'user_id',
        'titulo',
        'descripcion',
        'ingredientes',
        'instrucciones',
        'imagen',
    ];

    // Una receta puede tener muchas etiquetas y una etiqueta puede tener muchas recetas
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }

    // Una receta pertenece a una categoria  
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
   
    // Una receta pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }

}
