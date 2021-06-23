<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelo extends FormRequest
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
            'nombre'=>'required|min:1|unique:modelo,nombre',
            'nombre_marca'=>'required|exists:marca,nombre',
            'fecha_lanzamiento'=>'nullable',
            'imagen'=>'nullable|file|max:5120|mimes:jpg,bmp,png',
        ];
    }
}
