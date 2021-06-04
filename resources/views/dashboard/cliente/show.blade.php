@extends('layouts.baseAdmin')


@section('content')

    <div class="form-group">

        <h1 class="display-1">Lista de Clientes</h1>
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

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->apellido }}</td>
                                <td scope="row">{{ $cliente->dni }}</td>
                                <td>{{ $cliente->numero_de_telefono }}</td>
                                <td>{{ $cliente->email }}</td>
                                {{--  <td>
                                    <a class="btn btn-primary" href="">Ver</a>
                                    <a class="btn btn-primary" href="">Editar</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=""
                                        data-id="">Borrar</button>
                                </td>  --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
