@extends('layouts.baseAdmin')
@section('content')

    <div class="form-group">

        {{--  <form action="{{ route('marcas.store') }}" method="POST">  --}}

            <h1 class="display-1">Editar Cliente</h1>
            <hr>
            @include('dashboard.vistasParciales.createUpdateDelete-exitosa')
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    
                    <form action="{{ route('clientes.update', $cliente->dni) }}" method="POST">
                        @method('PUT')

                        @include('dashboard.cliente.FormularioCliente')

                    </form>

                </div>
            </div>
    </div>

@endsection
