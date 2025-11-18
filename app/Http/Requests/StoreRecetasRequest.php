<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;  // Importar la interfaz Validator 
use Illuminate\Http\Exceptions\HttpResponseException;  // Importar la excepción HttpResponseException 

class StoreRecetasRequest extends FormRequest
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
            'categoria_id' => 'required|exists:categorias,id', // La categoria_id es obligatoria y debe existir en la tabla categorias
            // 'user_id' => 'required|exists:users,id', // La usuario_id es obligatoria y debe existir en la tabla users
            'titulo' => 'required|string|max:255', // El titulo es obligatorio, debe ser una cadena y no debe exceder los 255 caracteres
            'descripcion' => 'required|string', // La descripcion es obligatoria y debe ser una cadena
            'ingredientes' => 'required|string', // Los ingredientes son obligatorios y deben ser una cadena
            'instrucciones' => 'required|string', // Las instrucciones son obligatorias y deben ser una cadena
            'imagen' => 'required|mimes:webp,jpeg,png,jpg,gif,svg|max:2048', // La imagen es opcional, debe ser un archivo de imagen y no debe exceder los 2MB
            'etiquetas' => 'required', // Las etiquetas son opcionales y deben ser un array
        ];
    }

    // Manejar la falla de validación y devolver una respuesta JSON personalizada
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Error de validación',
            'errors' => $validator->errors()
        ], 422));
    }
}
