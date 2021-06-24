@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <h1 class="display-1 text-center">Lista de Empleados</h1>
        <hr>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-11">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->apellido }}</td>
                                <td scope="row">{{ $empleado->dni }}</td>
                                <td>{{ $empleado->numero_de_telefono }}</td>
                                <td>{{ $empleado->email }}</td>
                                <td>
                                    {{--  <a class="btn btn-primary" href="">Ver</a>  --}}
                                    <a class="btn btn-primary" href="{{ route('empleados.edit', $empleado->dni) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Pagination --}}
    <div class="d-flex flex-row-reverse">
        {!! $empleados->links() !!}
    </div>

@endsection
