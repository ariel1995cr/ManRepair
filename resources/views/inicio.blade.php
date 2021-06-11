@extends('layouts.base')

@section('content')


<div class="container">
    <div class="col-12 text-center mt-5">
        <h1 class="display-1  justify-content-center">Conoce el estado<br /> de tu Orden de Servicio</h1>
    </div>
    <form action="{{route('orden.buscar')}}" method="GET">
        <div class="row justify-content-center">
            <div class="col-9 col-lg-8">
                <input type="text" name="nroOrdenDeServicio" class="form-control" id="nroOrdenDeServicio" placeholder="Ingresa tu orden de servicio" value="{{ empty($nroOrdenDeServicio) ? '' : $nroOrdenDeServicio }}">
            </div>
            <div class="col-2 col-lg-auto">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </div>
        </div>
    </form>

    @yield('ordenDeServicio')
</div>

@stop
