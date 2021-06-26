@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <h1 class="display-1 text-center">Lista de Modelos</h1>
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
                                <td>{{ $modelo->fecha_lanzamiento == '' ? '' : $modelo->fecha_lanzamiento->format('d/m/Y')  }}</td>
                                <td>
                                    @if ($modelo->foto)
                                        <img width="50px" height="50px" src="{{ $modelo->foto }}">
                                    @else
                                        No hay imagen.
                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-primary" href="">Ver</a> --}}


                                    @if (is_null($modelo->deleted_at))
                                        <a class="btn btn-primary"
                                           href="{{ route('modelos.edit', $modelo->nombre) }}">Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalBorrado" data-idModelo="{{ $modelo->nombre }}">Borrar</button>
                                    @else
                                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalReactivar"
                                            data-idModelo="{{ $modelo->nombre }}">Recuperar</button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <form action="{{ route('modelos.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="modalBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro que quiere eliminar este modelo?</p>
                        <input name="nombre" hidden readonly id="nombreMarca" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('modelos.reactivar') }}" method="POST">
        @csrf
        <div class="modal fade" id="modalReactivar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro que quiere reactivar este modelo?</p>
                        <input name="nombre" hidden readonly id="nombreMarcaReactivar" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Recuperar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pagination --}}
        <div class="d-flex flex-row-reverse">
            {!! $modelos->links() !!}
        </div>
    </form>
    <script>
        window.onload = function carga() {
            modalEvento();
        }

    </script>
@endsection
