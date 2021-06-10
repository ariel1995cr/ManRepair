@extends('layouts.baseAdmin')
@section('content')

    <div class="form-group">

        {{--  <form action="{{ route('marcas.store') }}" method="POST">  --}}

            <h1 class="display-1">Editar Marca</h1>
            <hr>
            @include('dashboard.vistasParciales.createUpdateDelete-exitosa')
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    
                    <form action="{{ route('marcas.update', $marca->nombre) }}" method="POST">
                        @method('PUT')

                        @include('dashboard.marca.formularioMarca')

                    </form>

                </div>
            </div>
    </div>

@endsection
