@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <h1 class="display-1">Lista de Modelos</h1>
        <hr>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-11">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Fecha de lanzamiento</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelos as $modelo)
                            <tr>
                                <td scope="row">{{ $modelo->nombre_marca }}</td>
                                <td>{{ $modelo->nombre }}</td>
                                <td>{{ $modelo->fecha_lanzamiento }}</td>
                                <td>{{ $modelo->foto }}</td>
                                <td>
                                    {{--  <a class="btn btn-primary" href="">Ver</a>  --}}
                                    <a class="btn btn-primary" href="{{ route('modelos.edit', $modelo->nombre) }}">Editar</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=""
                                        data-id="">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
