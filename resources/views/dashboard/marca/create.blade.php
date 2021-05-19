@extends('dashboard.master')

@include('dashboard.vistasParciales.navBar')
@section('contenido')

    <div class="form-group">
        
        <form action="{{ route('marcas.store') }}" method="POST">
        
            @include('dashboard.marca.formularioMarca')
    
        </form>
    </div>

@endsection
