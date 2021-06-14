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
            'nombre'=>'required|min:5|unique:modelo,nombre',
            'nombre_marca'=>'required|min:5',
            'fecha_lanzamiento'=>'nullable',
            'foto'=>'nullable|file|max:5120|mimes:jpg,bmp,png',
            // 'nombre'=>'required|min:2|unique:modelo,nombre',
            // 'nombre_marca'=>'required|exists:marca,nombre',
            // 'fecha_lanzamiento'=>'nullable',
            // 'imagen'=>'nullable|file|max:5120|mimes:jpg,bmp,png',
        ];
    }
}
