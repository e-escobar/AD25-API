<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory; // importar la clase Factory
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas
use Illuminate\Support\Str; // Para generar cadenas aleatorias

use App\Models\User; // importar el modelo User
use App\Models\Receta; // importar el modelo Receta
use App\Models\Categoria; // importar el modelo Categoria
use App\Models\Etiqueta; // importar el modelo Etiqueta

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Eric Escobar Mendoza',
            'email' => 'eescobar@laravel.com',
        ]);

        User::factory(29)->create();


        Categoria::factory(10)->create();
        Receta::factory(100)->create();
        Etiqueta::factory(40)->create();


        // Relación muchos a muchos
        $recetas = Receta::all();
        $etiquetas = Etiqueta::all();

        // Asignar entre 2 y 4 etiquetas aleatorias a cada receta
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
        foreach ($recetas as $receta) {
            $receta->etiquetas()->attach($etiquetas->random(rand(2, 4)));
        }

    }
}
