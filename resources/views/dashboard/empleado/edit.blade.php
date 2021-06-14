@extends('layouts.baseAdmin')
@section('content')

    <div class="form-group">

        {{--  <form action="{{ route('marcas.store') }}" method="POST">  --}}

            <h1 class="display-1 text-center">Editar Empleado</h1>
            <hr>
            @include('dashboard.vistasParciales.createUpdateDelete-exitosa')
            @include('dashboard.vistasParciales.validacion-errores')
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <form action="{{ route('empleados.update', $empleado->dni) }}" method="POST">
                        @method('PUT')

                        @include('dashboard.empleado.formularioEmpleado')

                    </form>
                </div>
            </div>
    </div>

@endsection
