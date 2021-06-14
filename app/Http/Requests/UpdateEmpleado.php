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
            'nombre'=>'required|min:5|regex:/^[\pL\s\-]+$/u',
            'apellido'=>'required|min:5|regex:/^[\pL\s\-]+$/u',
            'dni' => 'unique:cliente,dni,'.$this->request->get('dni').',dni',
            'numero_de_telefono'=>'required|integer',  
            'email' => 'unique:cliente,email,'.$this->request->get('dni').',dni',
            'contrasena' => 'required|min:6|string|confirmed',
        ];
    }
}