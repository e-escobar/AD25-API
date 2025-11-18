<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;  // Importar la interfaz Validator
use Illuminate\Http\Exceptions\HttpResponseException;  // Importar la excepción HttpResponseException

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecetasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  // Permitir que cualquier usuario pueda hacer esta solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoria_id' => 'sometimes|exists:categorias,id', // La categoria_id es opcional y debe existir en la tabla categorias
            // 'user_id' => 'sometimes|exists:users,id', // La usuario_id es opcional y debe existir en la tabla users
            'titulo' => 'sometimes|string|max:255', // El titulo es opcional, debe ser una cadena y no debe exceder los 255 caracteres
            'descripcion' => 'sometimes|string', // La descripcion es opcional y debe ser una cadena
            'ingredientes' => 'sometimes|string', // Los ingredientes son opcionales y deben ser una cadena
            'instrucciones' => 'sometimes|string', // Las instrucciones son opcionales y deben ser una cadena
            'imagen' => 'sometimes|mimes:webp,jpeg,png,jpg,gif,svg|max:2048', // La imagen es opcional, debe ser un archivo de imagen y no debe exceder los 2MB
            'etiquetas' => 'sometimes', // Las etiquetas son opcionales y deben ser un array
        ];

    }

    // Manejar la falla de validación y devolver una respuesta JSON personalizada
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación en la actualización',
            'errors' => $validator->errors()
        ], 422));
    }
}
