<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receta>
 */
class RecetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id' => \App\Models\Categoria::all()->random()->id, // Asignar una categoria aleatoria existente
            'user_id' => \App\Models\User::all()->random()->id, // Asignar un usuario aleatorio existente
            'titulo' => fake()->sentence(), // Título de la receta
            'descripcion' => fake()->text(), // Descripción de la receta
            'ingredientes' => fake()->text(), // Ingredientes de la receta
            'instrucciones' => fake()->text(), // Instrucciones de la receta
            'imagen' => fake()->imageUrl(640, 480), // URL de una imagen aleatoria
        ];
    }
}
