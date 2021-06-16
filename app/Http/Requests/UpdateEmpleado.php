<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleado extends FormRequest
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
            'nombre'=>'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellido'=>'required|min:2|regex:/^[\pL\s\-]+$/u',
            'dni' => 'required|numeric|digits_between:7,8|unique:empleado,dni,'.$this->empleado->dni.',dni',
            'numero_de_telefono'=>'required|numeric|digits:10',
            'email' => 'required|unique:empleado,email,'.$this->empleado->dni.',dni',
            'contrasena' => 'nullable|min:6|string|confirmed',
            'rol'=>'required|in:1,2'
        ];
    }
}
