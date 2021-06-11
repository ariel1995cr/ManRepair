<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCliente extends FormRequest
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
            'dni'=>'required|unique:cliente,dni',
            'numero_de_telefono'=>'required|integer',
            'email'=>'required|email|unique:cliente,email',
        ];
    }
}
