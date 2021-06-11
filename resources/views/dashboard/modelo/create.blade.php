@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        
        <form action="{{ route('modelos.store') }}" method="POST">

            <h1 class="display-1 text-center">Crear Modelo</h1>
            <hr>
            @include('dashboard.vistasParciales.createUpdateDelete-exitosa')
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    @include('dashboard.modelo.formularioModelo')
                </div>
            </div>
        </form>
    </div>

@endsection