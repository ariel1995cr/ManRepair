<?php

namespace App\Http\Controllers;

use App\Http\Requests\altaReingresoRequest;
use App\Http\Requests\BuscarOrdenDeServicioRequest;
use App\Http\Requests\CambiarEstadoRequest;
use App\Http\Requests\RequestSaveOrdenDeServicio;
use App\Http\Requests\StoreCliente;
use App\Models\Celular;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\HistorialEstadoOrdenDeServico;
use App\Models\Marca;
use App\Models\OrdenDeServicio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Support\Collection;

class OrdenDeServicioController extends Controller
{
    //
    private $cliente;
    private $ordenDeServicio;
    private $celular;
    private $estado;
    private $historialEstado;

    public function __construct(){
        $this->cliente = new Cliente();
        $this->ordenDeServicio = new OrdenDeServicio();
        $this->celular = new Celular();
        $this->estado = new Estado();
        $this->historialEstado = new HistorialEstadoOrdenDeServico();
    }

    public function buscar(Request $request)
    {
        $nroOrdenDeServicio = $request->nroOrdenDeServicio;

        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$request->nroOrdenDeServicio)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();

        return view('ordenDeServicio')->with('nroOrdenDeServicio', $nroOrdenDeServicio)->with('ordenDeServicio', $this->ordenDeServicio);
    }

    public function create(){
        $marcas = new Marca();
        $marcas = $marcas->listarMarcas();
        return view('Admin.OrdenDeServicio.create', compact('marcas'));
    }

    public function createReingreso(){
        return view('Admin.OrdenDeServicio.createReingreso');
    }

    public function altaReingreso(altaReingresoRequest $request){
        $ordenAnterior = $this->ordenDeServicio->where('nro',$request->nro_orden_anterior)->first();
        if($ordenAnterior->imei != $request->imei){
            return back()->withInput()->withErrors(['message'=>'El IMEI no corresponde a la orden de servicio.']);
        }
        DB::beginTransaction();
        try {
            $this->ordenDeServicio->crearReingresoOrdenDeServicio($ordenAnterior->nro,$request->motivo_orden, $request->descripcion_estado_celular, $request->imei, $ordenAnterior->dni_cliente, $ordenAnterior->detalle_reparacion, $ordenAnterior->materiales_necesarios);
            $estado = new HistorialEstadoOrdenDeServico();
            $estado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
            $estado->nombre_estado = Estado::RECIBIDO;
            $estado->dni_empleado = Auth::user()->dni;
            $estado->save();
            $estado = new HistorialEstadoOrdenDeServico();
            $estado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
            $estado->nombre_estado = Estado::PRESUPUESTADO;
            $estado->dni_empleado = Auth::user()->dni;
            $estado->save();
            $estado = new HistorialEstadoOrdenDeServico();
            $estado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
            $estado->nombre_estado = Estado::ENREPARACION;
            $estado->dni_empleado = Auth::user()->dni;
            $estado->save();
            $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$this->ordenDeServicio->nro)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();
            DB::commit();
            return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio)->with('title', 'Reingreso creado correctamente');
        }catch (\Exception $e){
            DB::rollBack();
            return back()->withInput()->withErrors(['message'=>'Ocurrio algun error interno. Por favor reintente.']);
        }
    }

    public function validarOrdenyGarantia($nroOrdenDeServicio){
        if($this->ordenDeServicio->SinReingreso()->existe($nroOrdenDeServicio)->first() == null){
            return response()->json(['mensaje'=>'Orden de Servicio invalida.'],404);
        }

        $resp = $this->ordenDeServicio->CoberturaValida($nroOrdenDeServicio);

        if($resp['valido'] === true){
            $error = false;
            $this->ordenDeServicio = $this->ordenDeServicio->where('nro', $nroOrdenDeServicio)->first();
                $this->ordenDeServicio->historico_estado->each(function ($item, $key) use(&$error){
                   if($item->nombre == Estado::NOREPARADO){
                      $error = true;
                   }
                });
            if($error){
                return response()->json(['mensaje'=>'Esta orden no fue reparada.'],404);
            }
            return response()->json(['mensaje'=>'Orden valida.', 'orden'=> $this->ordenDeServicio], 202);
        }else{
            return response()->json(['mensaje'=>$resp['mensaje']],404);
        }

    }

    public function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );

        return $paginator;
    }

    public function listar(BuscarOrdenDeServicioRequest $request){
        if($request->campoBusqueda == null || $request->valorBusqueda == null){
            $ordenesDeServicios = $this->ordenDeServicio
                ::with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->get();
        }else{
            $ordenesDeServicios = $this->ordenDeServicio->Buscar($request->campoBusqueda, $request->valorBusqueda)->get();

            if($request->campoBusqueda=="nombre_estado" && $request->valorBusqueda != ""){
                $busqueda = $request->valorBusqueda;
                $ordenesDeServicios = $ordenesDeServicios->filter(function ($item)use($busqueda){
                    return false !== stripos($item->estado_actual, $busqueda);
                });
            }
        }

        $myCollectionObj = collect($ordenesDeServicios);
        $ordenesDeServicios = $this->paginateCollection($myCollectionObj,15);

        return view('Admin.OrdenDeServicio.listar')->with('ordenesDeServicios', $ordenesDeServicios);
    }

    public function cambiarEstadoView($nroOrdenDeServicio){
        $ordenDeServicio =  $this->ordenDeServicio->firstWhere('nro',$nroOrdenDeServicio);
        $estadosPosibles = $this->estado->obtenerEstadoPosibles($ordenDeServicio->estado_actual);
        return view('Admin.OrdenDeServicio.cambiarEstado', compact('ordenDeServicio', 'estadosPosibles'));
    }

    public function verOrdenDeServicio(OrdenDeServicio $nroOrdenDeServicio){
        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$nroOrdenDeServicio->nro)->with('historico_estado', 'celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();
        return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio)->with('title', 'Ver Orden de servicio');
    }

    public function cambiarEstado(OrdenDeServicio $nroOrdenDeServicio, CambiarEstadoRequest $request){
        $this->ordenDeServicio = $nroOrdenDeServicio;
        if($request->nombre_estado == $this->estado::PRESUPUESTADO){
            $this->ordenDeServicio->detalle_reparacion = $request->detalle_reparacion;
            $this->ordenDeServicio->materiales_necesarios = $request->materiales_necesarios;
            $this->ordenDeServicio->importe_reparacion = $request->importe_reparacion;
            $this->ordenDeServicio->tiempo_de_reparacion = $request->tiempo_de_reparacion;
            $this->ordenDeServicio->save();
        }
        if($request->nombre_estado == $this->estado::NOREPARADO){
            $this->ordenDeServicio->detalle_reparacion = $request->detalle_reparacion;
            $this->ordenDeServicio->materiales_necesarios = $request->materiales_necesarios;
            $this->ordenDeServicio->importe_reparacion = 0;
            $this->ordenDeServicio->tiempo_de_reparacion = $request->tiempo_de_reparacion;
            $this->ordenDeServicio->save();
        }
        $this->historialEstado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
        $this->historialEstado->nombre_estado = $request->nombre_estado;
        $this->historialEstado->comentario = $request->comentario;
        $this->historialEstado->dni_empleado = Auth::user()->dni;
        $this->historialEstado->save();
        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$this->ordenDeServicio->nro)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();

        return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio)->with('title', 'Estado orden de servicio modificada correctamente.');
    }

    public function store(RequestSaveOrdenDeServicio $request){
        DB::beginTransaction();
        try {

        if($celular = $this->celular->where('imei', $request->imei)->first()){
            if($celular->nombre_marca != $request->marca || $celular->nombre_modelo != $request->modelo){
                return back()->withInput()->withErrors(['message'=>'El IMEI no coincide con la marca o el modelo.']);
            }
        }

        if($ultimaordenDeServicio = $this->ordenDeServicio->where('imei', $request->imei)->latest('created_at')->first()){
            if($ultimaordenDeServicio->estado_actual != Estado::REPARADO){
                return back()->withInput()->withErrors(['message'=>'Existe una orden de servicio actualmente en curso.']);
            }
        }

        $cliente = $this->cliente::buscarCliente('dni', $request->dni)->first();
        if($cliente == null){
            $this->cliente->dni = $request->dni;
            $this->cliente->email = $request->email;
            $this->cliente->nombre = $request->nombre;
            $this->cliente->apellido = $request->apellido;
            $this->cliente->numero_de_telefono = $request->numero_de_telefono;
            $validate = Validator::make($this->cliente->toArray(), (new StoreCliente())->rules());
            if($validate->fails()){
                return back()
                    ->withErrors($validate)
                    ->withInput();
            }
            $this->cliente->save();
        }else{
            $this->cliente->where('dni',$request->dni);
        }

        $this->celular->firstOrCreate(
            ['imei'=>$request->imei],
            ['nombre_marca'=>$request->marca, 'nombre_modelo'=>$request->modelo]
        );


        $this->ordenDeServicio->crearOrdenDeServicio($request->motivo_orden, $request->estado, $request->imei, $request->dni);

        $this->historialEstado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
        $this->historialEstado->nombre_estado = 'Recibido';
        $this->historialEstado->dni_empleado = Auth::user()->dni;
        $this->historialEstado->save();

        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$this->ordenDeServicio->nro)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();
        DB::commit();
        return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio)->with('title', 'Orden de servicio creada correctamente.');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
            return back()->withInput()->withErrors(['message'=>'Ocurrio algun error interno. Por favor reintente.']);
        }
    }

}
