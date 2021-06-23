<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModelo extends FormRequest
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
            'nombre'=>'required|min:1|unique:modelo,nombre,'.$this->modelo->nombre.',nombre',
            'nombre_marca'=>'required|exists:marca,nombre|unique:modelo,nombre_marca,'.$this->modelo->nombre_marca.',nombre_marca',
            'fecha_lanzamiento'=>'nullable',
            'foto'=>'nullable|file|max:5120|mimes:jpg,bmp,png',

        ];
    }
}
