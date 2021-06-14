<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarca extends FormRequest
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
            'nombre'=>'required|min:5|unique:marca,nombre,'.$this->marca->nombre.',nombre',
            'logo'=>'nullable|file|max:5120|mimes:jpg,bmp,png',
        ];
    }
}