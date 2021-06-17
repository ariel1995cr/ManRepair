@extends('layouts.baseAdmin')


@section('content')

    <div class="form-group">


        <form action="{{ route('clientes.store') }}" method="POST">

            <h1 class="display-1 text-center">Registrar Cliente</h1>
            <hr>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    @include('dashboard.cliente.FormularioCliente')
                </div>
            </div>
        </form>

    </div>

@endsection
