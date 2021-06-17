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
            'imei' => 'required|numeric|digits_between:15,15',
            'dni' => 'required|numeric|digits_between:7,8',
            'email' => 'required|email',
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:2',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|min:2',
            'numero_de_telefono' => 'required|integer',
            'estado' => 'required',
            'marca'=>'required|exists:marca,nombre',
            'modelo'=>'required|exists:modelo,nombre',
        ];
    }
}
