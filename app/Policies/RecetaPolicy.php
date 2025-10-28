<?php

namespace App\Policies;

use App\Models\User;  // Importar el modelo User
use App\Models\Receta;  // Importar el modelo Receta

class RecetaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // Determinar si el usuario puede actualizar la receta
    public function update(User $user, Receta $receta)
    {
        return $user->id === $receta->user_id;
    }

    // Determinar si el usuario puede eliminar la receta
    public function delete(User $user, Receta $receta)
    {
        return $user->id === $receta->user_id;
    }

}
