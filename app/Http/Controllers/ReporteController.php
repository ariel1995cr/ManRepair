<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerarReporteRequest;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\OrdenDeServicio;
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
        if($request->tipo_reporte == 'reporte de servicio'){
            $view = $this->generarReporteServicios($request->fecha, $request->estado);
            return $view->download('reporte_de_servicio.pdf');
        }
        if($request->tipo_reporte == 'cantidad de reparados'){
            $view = $this->generarReporteCantidadReparados($request->fechaDesde, $request->fechaHasta, $request->marca);
            return $view->download('reporte_cantidad_reparados_por_marca.pdf');
        }
        if($request->tipo_reporte =='reparados por garantia del celular'){
            $view = $this->generarReporteReparadosPorGarantia($request->fechaDesde, $request->fechaHasta);
            return $view->download('reporte_reparados_por_garantida_celular.pdf');
        }
    }

    public function generarReporteServicios($fecha, $estado){
        $ordenesDeServicio = $this->ordenDeServicio->filtroServicios($fecha, $estado)->get();
        $data = [
            'filtros'=> [
                'fecha' => $fecha,
                'estado' => $estado,
            ],
            'ordenes'=> $ordenesDeServicio,
            'titulo'=> 'Reporte de servicios'
        ];

        return PDF::loadView('pdf.reporteservicio', $data)->setPaper('a4', 'landscape');
    }

    public function generarReporteCantidadReparados($desde, $hasta, $marca){
        $ordenesDeServicio = $this->ordenDeServicio->cantidadReparadosPorMarca($desde,$hasta, $marca)->get()->groupBy('celular.nombre_marca')->map(function ($row) {
            return $row->count();
        });
        $data = [
            'filtros'=> [
                'Fecha desde' => $desde,
                'Fecha hasta' => $hasta,
                'Nombre marca' => $marca,
            ],
            'ordenes'=> $ordenesDeServicio,
            'titulo'=> 'Reporte cantidad de reparados por marca'
        ];
        return PDF::loadView('pdf.reporteCantidadReparadosMarca', $data)->setPaper('a4', 'landscape');
    }

    public function generarReporteReparadosPorGarantia($desde, $hasta){
        $ordenesDeServicio = $this->ordenDeServicio->reparadosPorGarantia($desde, $hasta)->get();
        $data = [
            'filtros'=> [
                'Fecha desde' => $desde,
                'Fecha hasta' => $hasta,
            ],
            'ordenes'=> $ordenesDeServicio,
            'titulo'=> 'Reporte de reparados por garantia'
        ];

        return PDF::loadView('pdf.reporteservicio', $data)->setPaper('a4', 'landscape');
    }

}
