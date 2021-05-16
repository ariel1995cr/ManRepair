@extends('layouts.base')

@section('content')


<div class="container">
    <div class="col-12 text-center">
        <h1 class="display-1">Conoce el Estado<br /> de tu Orden De Servicio</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-9 col-lg-8">
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Ingresa tu orden de servicio">
        </div>
        <div class="col-2 col-lg-auto">
            <button type="button" class="btn btn-secondary">Buscar</button>
        </div>
    </div>
</div>

@stop