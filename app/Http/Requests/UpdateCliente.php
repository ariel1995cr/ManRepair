<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCliente extends FormRequest
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

        // dd($this->cliente->dni);
        return [
            'nombre'=>'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellido'=>'required|min:2|regex:/^[\pL\s\-]+$/u',
            'dni' => 'required|numeric|digits_between:7,8|unique:cliente,dni,'.$this->cliente->dni.',dni',
            'numero_de_telefono'=>'required|numeric|digits:10',
            'email' => 'required|unique:cliente,email,'.$this->cliente->dni.',dni'
        ];
    }
}
