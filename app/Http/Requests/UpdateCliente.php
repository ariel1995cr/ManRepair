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
            'nombre'=>'required|min:5|regex:/^[\pL\s\-]+$/u',
            'apellido'=>'required|min:5|regex:/^[\pL\s\-]+$/u',
            'dni' => 'unique:cliente,dni,'.$this->cliente->dni.',dni',
            'numero_de_telefono'=>'required|integer',
            // 'email'=>'required|email|unique:cliente,email',
            'email' => 'unique:cliente,email,'.$this->cliente->dni.',dni'
        ];
    }
}
