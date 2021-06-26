@extends('layouts.basePdf')
@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col"><span class="fs-4">ManRepair</span></th>
            <th scope="col">
                {{$titulo}}
                <br>
                Generado por: {{Auth::user()->nombre}} {{Auth::user()->apellido}}</th>
                <th scope="col" colspan="7">
                Filtros utilizados:
                <br>
                @foreach($filtros as $key => $filtro)
                    <span class="text-capitalize">{{$key}}</span>: {{$filtro}}
                    <br>
                @endforeach
            </th>
        </tr>
        <tr>
            <th scope="col">Nro</th>
            <th scope="col">Motivo de la orden</th>
            <th scope="col">IMEI</th>
            <th scope="col">Modelo</th>
            <th scope="col">Marca</th>
            <th scope="col">Cliente</th>
            <th scope="col">Número de teléfono</th>
            <th scope="col">Fecha de ingreso</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordenes as $orden)
            <tr>
                <th scope="row">{{$orden->nro}}</th>
                <td>{{$orden->motivo_orden}}</td>
                <td>{{$orden->celular->imei}}</td>
                <td>{{$orden->celular->nombre_modelo}}</td>
                <td>{{$orden->celular->nombre_marca}}</td>
                <td>{{$orden->cliente->apellido}} {{$orden->cliente->nombre}}</td>
                <td>{{$orden->cliente->numero_de_telefono}}</td>
                <td>{{$orden->created_at->format('d/m/Y')}}</td>
                <td>{{$orden->estado_actual}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
