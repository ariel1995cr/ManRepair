@extends('layouts.baseAdmin')
@section('content')

    <div class="form-group">

        {{--  <form action="{{ route('marcas.store') }}" method="POST">  --}}

            <h1 class="display-1 text-center">Editar Cliente</h1>
            <hr>
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
