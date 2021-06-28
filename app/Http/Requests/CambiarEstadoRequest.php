<?php

namespace App\Http\Requests;

use App\Models\Estado;
use Carbon\Carbon;
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
                'comentario' => 'nullable'
            ];
        }
        if($this->request->get('nombre_estado') == Estado::PRESUPUESTADO){
            return [
                'nombre_estado' => 'required',
                'detalle_reparacion' => 'required',
                'materiales_necesarios' => 'required',
                'importe_reparacion'=> 'required|integer|min:0',
                'tiempo_de_reparacion' => 'required|date|after_or_equal:'.date('m/d/Y'),
                'comentario' => 'nullable',
            ];
        }
    }

    public function messages()
    {
        return [
            'tiempo_de_reparacion.after_or_equal' => 'El campo tiempo de reparacion debe ser una fecha posterior o igual a '.Carbon::now()->format('d/m/Y').',',
        ];
    }
}
