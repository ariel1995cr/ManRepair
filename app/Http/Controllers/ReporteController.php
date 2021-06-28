<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerarReporteRequest;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\OrdenDeServicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class ReporteController extends Controller
{
    //
    public function __construct(){
        $this->estados = new Estado();
        $this->marcas = new Marca();
        $this->ordenDeServicio = new OrdenDeServicio();
    }

    public function index(){
        $estados = $this->estados::all();
        $marcas = $this->marcas::all();
        return view('Admin.Reporte.index')->with('estados', $estados)->with('marcas', $marcas);
    }

    public function generarReporte(GenerarReporteRequest $request){

        if($request->fechaDesde > $request->fechaHasta){
            $aux = $request->fechaDesde;
            $request->fechaDesde = $request->fechaHasta;
            $request->fechaHasta = $aux;
        }
        if($request->tipo_reporte == 'reporte de servicio'){
            $view = $this->generarReporteServicios($request->fechaDesde, $request->fechaHasta, $request->estado);
            return $view->stream('reporte_de_servicio.pdf');
        }
        if($request->tipo_reporte == 'cantidad de reparados'){
            $view = $this->generarReporteCantidadReparados($request->fechaDesde, $request->fechaHasta, $request->marca);
            return $view->stream('reporte_cantidad_reparados_por_marca.pdf');
        }
        if($request->tipo_reporte =='reparados por garantia del celular'){
            $view = $this->generarReporteReparadosPorGarantia($request->fechaDesde, $request->fechaHasta, $request->marca);
            return $view->stream('reporte_reparados_por_garantida_celular.pdf');
        }
    }

    public function generarReporteServicios($desde, $hasta,$estado){
        $ordenesDeServicio = $this->ordenDeServicio->filtroServicios($desde, $hasta, $estado)->get();

        $filteredOrdenes = $ordenesDeServicio->filter(function ($value, $key) use($estado) {
            if($estado != 'todos'){
                if($value->estado_actual == $estado){
                    return $value;
                }
            }else{
                return $value;
            }
        });
        $desde = Carbon::createFromFormat('Y-m-d', $desde)->format('d/m/Y');
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->format('d/m/Y');

        $data = [
            'filtros'=> [
                'Fecha desde' => $desde,
                'Fecha hasta' => $hasta,
                'estado' => $estado,
            ],
            'ordenes'=> $filteredOrdenes,
            'titulo'=> 'Reporte de servicios'
        ];

        return PDF::loadView('pdf.reporteservicio', $data)->setPaper('a4', 'landscape');
    }

    public function generarReporteCantidadReparados($desde, $hasta, $marca){
        $ordenesDeServicio = $this->ordenDeServicio->cantidadReparadosPorMarca($desde,$hasta, $marca)->get()->filter(function ($value, $key){
            if($value->historico_estado->contains('nombre', Estado::REPARADO)){
                return $value;
            }
        })->groupBy('celular.nombre_marca')->map(function ($row) {
            return $row->count();
        });
        $desde = Carbon::createFromFormat('Y-m-d', $desde)->format('d/m/Y');
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->format('d/m/Y');

        $data = [
            'filtros'=> [
                'Fecha desde' => $desde,
                'Fecha hasta' => $hasta,
                'Marca' => $marca,
                'Estado' => Estado::REPARADO,
            ],
            'ordenes'=> $ordenesDeServicio,
            'titulo'=> 'Reporte cantidad de reparados por marca'
        ];
        return PDF::loadView('pdf.reporteCantidadReparadosMarca', $data)->setPaper('a4', 'landscape');
    }

    public function generarReporteReparadosPorGarantia($desde, $hasta, $marca){
        $ordenesDeServicio = $this->ordenDeServicio->reparadosPorGarantia($desde, $hasta, $marca)->get();

        $filteredOrdenes = $ordenesDeServicio->filter(function ($value, $key){
            if($value->historico_estado->contains('nombre', Estado::REPARADO)){
                return $value;
            }
        });

        $desde = Carbon::createFromFormat('Y-m-d', $desde)->format('d/m/Y');
        $hasta = Carbon::createFromFormat('Y-m-d', $hasta)->format('d/m/Y');
        $data = [
            'filtros'=> [
                'Fecha desde' => $desde,
                'Fecha hasta' => $hasta,
                'Marca' => $marca,
            ],
            'ordenes'=> $filteredOrdenes,
            'titulo'=> 'Reporte de reparados por garantia'
        ];

        return PDF::loadView('pdf.reporteservicio', $data)->setPaper('a4', 'landscape');
    }

}
