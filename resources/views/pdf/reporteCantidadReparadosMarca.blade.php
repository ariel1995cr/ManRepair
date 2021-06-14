@extends('layouts.basePdf')
@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">
                <span class="fs-4">ManRepair</span>
                <br>
                {{$titulo}}
            </th>
            <th scope="col">
                Generado por: {{Auth::user()->nombre}} {{Auth::user()->apellido}}</th>
            <th scope="col">
                Filtros utilizados:
                <br>
                @foreach($filtros as $key => $filtro)
                    <span class="text-capitalize">{{$key}}</span>: {{$filtro}}
                    <br>
                @endforeach
            </th>
        </tr>
        <tr>
            <th scope="col">Marca</th>
            <th scope=col" colspan="2">Cantidad reparados</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordenes as $key => $cantidad)
            <tr>
                <th scope="row">{{$key}}</th>
                <th colspan="2">{{$cantidad}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
