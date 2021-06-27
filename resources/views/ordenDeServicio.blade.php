@extends('inicio')

@section('ordenDeServicio')
@if($ordenDeServicio==NULL)
<div class="alert alert-danger d-flex align-items-center mt-2 text-center w-100" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div class="mt-2">
        <p>No existe la orden de servicio!</p>
    </div>
</div>
@else
    <div class="row p-4">
        @if($ordenDeServicio->ordenSiguiente != null)
            <div class="alert alert-info text-center" role="alert">
                <p><span class="fw-bold">Esta orden tuvo un reingreso por garantia.</span><br>
                    <span class="fw-bold">Nro Orden de Servicio:</span> {{$ordenDeServicio->ordenSiguiente->nro}}
                    <br>

                    <a href="{{route('orden.buscar', ['nroOrdenDeServicio'=>$ordenDeServicio->ordenSiguiente->nro])}}" class="text-black-50" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver reingreso de orden">
                        <button type="button" class="btn btn-outline-dark fw-bold">Ir al reingreso</button>
                    </a>
                </p>
            </div>
        @endif
        <div class="col-4 offset-1">
            <h1 class="display-6">Informaci&oacute;n General</h1>
            <div class="card border-1 border-dark px-4">
                <ul class="list-unstyled">
                    <li class="mt-2 fw-lighter fw-bold">Nro Orden de Servicio</li>
                    <li class="fw-lighter">{{$ordenDeServicio->nro}}</li>
                    <li class="mt-4 fw-lighter fw-bold">IMEI</li>
                    <li class="fw-lighter">{{$ordenDeServicio->celular->imei}}</li>
                    <li class="mt-4 fw-lighter fw-bold">Marca</li>
                    <li class="fw-lighter">{{$ordenDeServicio->celular->nombre_marca}}</li>
                    <li class="mt-4 fw-lighter fw-bold">Modelo</li>
                    <li class="fw-lighter">{{$ordenDeServicio->celular->nombre_modelo}}</li>
                    <li class="mt-4 fw-lighter fw-bold">Atendido por</li>
                    <li class="fw-lighter">{{$ordenDeServicio->empleado->nombre}} {{$ordenDeServicio->empleado->apellido}}</li>
                    @isset($ordenDeServicio->nro_orden_anterior)
                        <li class="mt-4 fw-lighter fw-bold">Nro orden de servicio anterior</li>
                        <li class="fw-lighter">{{$ordenDeServicio->nro_orden_anterior}}</li>
                    @endisset
                    <li class="mt-4 fw-lighter fw-bold">Cliente</li>
                    <li class="fw-lighter">{{$ordenDeServicio->cliente->nombre}} {{$ordenDeServicio->cliente->apellido}}</li>
                    <li class="mt-4 fw-lighter fw-bold">Teléfono del cliente</li>
                    <li class="fw-lighter">{{$ordenDeServicio->cliente->numero_de_telefono}}</li>
                    @isset($ordenDeServicio->detalle_reparacion)
                        <li class="mt-4 fw-lighter fw-bold">Detalle de reparacion</li>
                        <li class="fw-lighter">{{$ordenDeServicio->detalle_reparacion}}</li>
                    @endisset
                    @isset($ordenDeServicio->materiales_necesarios)
                        <li class="mt-4 fw-lighter fw-bold">Materiales necesarios</li>
                        <li class="fw-lighter">{{$ordenDeServicio->materiales_necesarios}}</li>
                    @endisset
                    @isset($ordenDeServicio->importe_reparacion)
                        <li class="mt-4 fw-lighter fw-bold">Importe de la reparaci&oacute;n</li>
                        <li class="fw-lighter">{{$ordenDeServicio->importe_reparacion}}</li>
                    @endisset
                    @isset($ordenDeServicio->tiempo_de_reparacion)
                        <li class="mt-4 fw-lighter fw-bold">Día estimado de entrega</li>
                        <li class="fw-lighter">{{$ordenDeServicio->tiempo_de_reparacion->format('d/m/Y H:i')}}</li>
                    @endisset
                </ul>
            </div>
        </div>
        <div class="col-4 offset-1">
            <h1 class="display-6">Estados</h1>
            <div class="card border-1 border-dark p-4">
                @foreach($ordenDeServicio->historico_estado as $key => $estado)
                    <div class="card mt-2" >
                        <div class="card-body bg-light">
                            <h5 class="card-title">{{$estado->nombre}}</h5>
                            <p class="card-text">{{$estado->pivot->created_at->format('d/m/Y H:i')}}
                                <br>
                                @if($estado->pivot->comentario != '')
                                    <span>Comentario: <br>{{$estado->pivot->comentario}}<br>
                                   @endif
                                       Realizado por {{\App\Models\Empleado::where('dni',$estado->pivot->dni_empleado)->first()->full_name}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection
