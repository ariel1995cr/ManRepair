@extends('layouts.baseAdmin')

@section('content')
    <div class="container">
        <div class="col-12 text-center mt-3">
            <h1 class="display-1">Bienvenido {{$user->apellido}} {{$user->nombre}}</h1>
        </div>
    </div>
@endsection
