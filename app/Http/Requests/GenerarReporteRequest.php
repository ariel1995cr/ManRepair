<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerarReporteRequest extends FormRequest
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
            'tipo_reporte' => 'required',
            'fecha'=> 'required_if:tipo_reporte,"reporte de servicio"',
            'estado'=> 'required_if:tipo_reporte,"reporte de servicio"',
            'fechaDesde' => 'required_if:tipo_reporte,"cantidad de reparados",required_if:tipo_reporte,"reparados por garantia del celular"',
            'fechaHasta' => 'required_if:tipo_reporte,"cantidad de reparados",required_if:tipo_reporte,"reparados por garantia del celular"',
            'marca' => 'required_if:tipo_reporte,"cantidad de reparados"',
        ];
    }
}
