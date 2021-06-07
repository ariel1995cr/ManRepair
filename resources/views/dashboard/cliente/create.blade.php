@extends('layouts.baseAdmin')


@section('content')

    <div class="form-group">

        
        <form action="{{ route('clientes.store') }}" method="POST">

            <h1 class="display-1">Crear Cliente</h1>
            <hr>
            @include('dashboard.vistasParciales.createUpdateDelete-exitosa')
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    @include('dashboard.cliente.formularioCliente')
                </div>
            </div>
        </form>
        
    </div>

@endsection