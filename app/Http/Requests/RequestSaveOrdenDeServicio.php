<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSaveOrdenDeServicio extends FormRequest
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
            'motivo_orden' => 'required',
            'imei' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'numero_de_telefono' => 'required',
            'estado' => 'required',
            'marca'=>'required',
            'modelo'=>'required',
        ];
    }
}
