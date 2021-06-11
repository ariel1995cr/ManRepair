<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Validator;

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

    public function listar(){
        $ordenesDeServicios = $this->ordenDeServicio::with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->paginate(15);
        return view('Admin.OrdenDeServicio.listar', compact('ordenesDeServicios'));
    }

    public function cambiarEstadoView(OrdenDeServicio $nroOrdenDeServicio){
        $ordenDeServicio =  $this->ordenDeServicio->find($nroOrdenDeServicio)->first();
        $estadosPosibles = $this->estado->obtenerEstadoPosibles($ordenDeServicio->estado_actual);
        return view('Admin.OrdenDeServicio.cambiarEstado', compact('ordenDeServicio', 'estadosPosibles'));
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
        $this->historialEstado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
        $this->historialEstado->nombre_estado = $request->nombre_estado;
        $this->historialEstado->comentario = $request->comentario;
        $this->historialEstado->save();
        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$this->ordenDeServicio->nro)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();

        return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio);
    }

    public function store(RequestSaveOrdenDeServicio $request){
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
            $this->cliente->find($request->dni);
        }

        $this->celular->firstOrCreate(
            ['imei'=>$request->imei],
            ['nombre_marca'=>$request->marca, 'nombre_modelo'=>$request->modelo]
        );


        $this->ordenDeServicio->crearOrdenDeServicio($request->motivo_orden, $request->estado, $request->imei, $request->dni);

        $this->historialEstado->nro_orden_de_servicio = $this->ordenDeServicio->nro;
        $this->historialEstado->nombre_estado = 'Recibido';
        $this->historialEstado->save();

        $this->ordenDeServicio = $this->ordenDeServicio->where('nro',$this->ordenDeServicio->nro)->with('historico_estado','celular', 'empleado:dni,nombre,apellido', 'cliente:dni,nombre,apellido,numero_de_telefono')->first();

        return view('Admin.OrdenDeServicio.createSucces')->with('ordenDeServicio', $this->ordenDeServicio);
    }

}
