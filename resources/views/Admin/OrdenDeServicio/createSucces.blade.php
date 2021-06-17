@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">{{$title}}</h1>
        <hr>
       <div class="row p-4">
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
                       @isset($ordenDeServicio->materiales_necesarios)
                           <li class="mt-4 fw-lighter fw-bold">Importe de la reparaci&oacute;n</li>
                           <li class="fw-lighter">{{$ordenDeServicio->materiales_necesarios}}</li>
                       @endisset
                       @isset($ordenDeServicio->tiempo_de_reparacion)
                           <li class="mt-4 fw-lighter fw-bold">Día estimado de entrega</li>
                           <li class="fw-lighter">{{$ordenDeServicio->tiempo_de_reparacion}}</li>
                       @endisset
                   </ul>
               </div>
           </div>
           <div class="col-4 offset-1">
               <h1 class="display-6">Estados</h1>
               <div class="card border-1 border-dark p-4">
                   @foreach($ordenDeServicio->historico_estado as $estado)
                       <div class="card mt-2" >
                           <div class="card-body bg-light">
                               <h5 class="card-title">{{$estado->nombre}}</h5>
                               <p class="card-text">{{$estado->pivot->created_at}}
                                   <br>
                                   Comentario: <br>{{$estado->pivot->comentario}}</p>
                           </div>
                       </div>
                   @endforeach
               </div>
           </div>
       </div>
    </div>
@endsection
