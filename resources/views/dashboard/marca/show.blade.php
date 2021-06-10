@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <h1 class="display-1">Lista de Marcas</h1>
        <hr>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-11">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Acciones</th>
                            {{-- <th scope="col">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marcas as $marca)
                            <tr>
                                <td scope="row">{{ $marca->nombre }}</td>
                                <td>{{ $marca->logo }}</td>
                                <td>

                                    <a class="btn btn-primary"
                                        href="{{ route('marcas.edit', $marca->nombre) }}">Editar</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalBorrado" data-id="">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection
