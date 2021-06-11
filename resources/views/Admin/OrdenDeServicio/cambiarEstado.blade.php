@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">Modificar Estado Orden De Servicio - {{$ordenDeServicio->nro}}</h1>
        <hr>

        <form id="formCrearOrdenDeServicio" action="{{route('ordenDeServicio.store')}}" method="POST" >
            @csrf
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-4">
                    <p>Estado Actual: {{$ordenDeServicio->estado_actual}}</p>
                    <label>Nuevo Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Seleccionar estado</option>
                        @foreach($estadosPosibles as $estado)
                            <option>{{$estado->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
@endsection
