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
                <th>Ingreso</th>
                <th>Ultima actualizaci&oacute;n</th>
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
                    <td>{{$orden->cliente->nombre}} {{$orden->cliente->apellido}}</td>
                    <td>{{$orden->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="float-end mx-4">
            {{ $ordenesDeServicios->links() }}
        </div>
    </div>
@endsection
