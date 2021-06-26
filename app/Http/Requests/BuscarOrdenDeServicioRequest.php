<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarOrdenDeServicioRequest extends FormRequest
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
        if($this->request->get('campoBusqueda') == null){
            return [

            ];
        }
        if($this->request->get('campoBusqueda') == 'nro'){
            return [
                //
                'valorBusqueda'=>'nullable|numeric',
            ];
        }
        if($this->request->get('campoBusqueda') == 'imei'){
            return [
                //
                'valorBusqueda'=>'nullable|numeric',
            ];
        }
        if($this->request->get('campoBusqueda') == 'created_at'){
            return [
                //
                'valorBusqueda'=>'nullable|date_format:d/m/Y',
            ];
        }

        return [

        ];


    }
}
