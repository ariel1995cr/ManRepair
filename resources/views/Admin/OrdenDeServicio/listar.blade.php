@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">Listado de ordenes de servicio</h1>
        <hr>
        <table class="table">
            <thead>
            <tr>
                <th>Nro</th>
                <th>Motivo orden</th>
                <th>IMEI</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cliente</th>
                <th>Atendido por</th>
                <th>Ingreso</th>
                <th>Estado actual</th>
                <th>Ultima actualizaci&oacute;n</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ordenesDeServicios as $orden)
                <tr>
                    <th>{{$orden->nro}}</th>
                    <td>{{$orden->motivo_orden}}</td>
                    <td>{{$orden->celular->imei}}</td>
                    <td>{{$orden->celular->nombre_marca}}</td>
                    <td>{{$orden->celular->nombre_modelo}}</td>
                    <td>{{$orden->cliente->apellido}} {{$orden->cliente->nombre}}</td>
                    <td>{{$orden->empleado->apellido}} {{$orden->empleado->nombre}}</td>
                    <td>{{$orden->created_at}}</td>
                    <td>{{$orden->estado_actual}}</td>
                    <td>{{$orden->ultima_actualizacion}}</td>
                    <td>
                            <a href="{{route('admin.ordenDeServicio.cambiarEstado', ['nroOrdenDeServicio'=>$orden->nro])}}" class="text-black-50" data-bs-toggle="tooltip" data-bs-placement="left" title="Cambiar estado">
                               <button class="botonTransparente" type="submit">
                                   <i class="bi bi-arrow-repeat"></i>
                               </button>
                            </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="float-end mx-4">
            {{ $ordenesDeServicios->links() }}
        </div>
    </div>
@endsection
