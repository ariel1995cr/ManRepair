<?php

namespace App\Http\Requests;

use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class CambiarEstadoRequest extends FormRequest
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
        if($this->request->get('nombre_estado') != Estado::PRESUPUESTADO){
            return [
                'comentario' => 'required'
            ];
        }
        if($this->request->get('nombre_estado') == Estado::PRESUPUESTADO){
            return [
                'nombre_estado' => 'required',
                'detalle_reparacion' => 'required',
                'materiales_necesarios' => 'required',
                'importe_reparacion'=> 'required|integer',
                'tiempo_de_reparacion' => 'required|date',
                'comentario' => 'required'
            ];
        }
    }
}
