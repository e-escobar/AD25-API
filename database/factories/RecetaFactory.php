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
            'categoria_id' => \App\Models\Categoria::all()->random()->id, // Asignar una categoria aleatoria existente a la receta 
            'user_id' => \App\Models\User::all()->random()->id, // Asignar un usuario aleatorio existente como autor de la receta 
            'titulo' => fake()->sentence(), // sentence genera una frase aleatoria
            'descripcion' => fake()->text(), // text genera un texto aleatorio
            'ingredientes' => fake()->text(), 
            'instrucciones' => fake()->text(), 
            'imagen' => fake()->imageUrl(640, 480), // imageUrl genera una URL de imagen aleatoria
        ];
    }
}
