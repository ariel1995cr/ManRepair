@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <form action="{{ route('empleados.store') }}" method="POST">

            <h1 class="display-1 text-center">Crear Empleado</h1>
            <hr>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    @include('dashboard.empleado.FormularioEmpleado')
                </div>
            </div>
        </form>
    </div>

@endsection
