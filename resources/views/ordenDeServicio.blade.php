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
                    <li class="mt-4 fw-lighter fw-bold">Cliente</li>
                    <li class="fw-lighter">{{$ordenDeServicio->cliente->nombre}} {{$ordenDeServicio->cliente->apellido}}</li>
                    <li class="mt-4 fw-lighter fw-bold">Teléfono del cliente</li>
                    <li class="fw-lighter">{{$ordenDeServicio->cliente->numero_de_telefono}}</li>
                </ul>
            </div>
        </div>
        <div class="col-4 offset-1">
            <h1 class="display-6">Estados</h1>
            <div class="card border-1 border-dark p-4">
                    @foreach($ordenDeServicio->historico_estado as $estado)
                    <div class="card mt-2" style="width: 18rem;">
                        <div class="card-body bg-light">
                            <h5 class="card-title">{{$estado->nombre}}</h5>
                            <p class="card-text">{{$estado->pivot->created_at}}</p>
                        </div>
                    </div>
                    @endforeach

            </div>
        </div>
    </div>
@endif
@endsection
