@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">Listado de ordenes de servicio</h1>
        <hr>
        @foreach($ordenesDeServicios as $orden)
            {{print_r($orden)}}
        @endforeach
    </div>
@endsection
