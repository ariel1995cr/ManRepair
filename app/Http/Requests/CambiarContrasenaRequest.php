<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CambiarContrasenaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'contrasena' => 'required|current_password',
            'contrasenaNueva' => ['required','different:contrasena','confirmed', Password::min(6)],
            'contrasenaNueva_confirmation' => 'required','same:contrasenaNueva',
        ];
    }

    public function messages()
    {
        return [
          'contrasena.current_password' => 'La contraseña no es la contraseña actual.'
        ];
    }
}
