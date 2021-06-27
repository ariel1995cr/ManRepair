@extends('layouts.baseAdmin')

{{-- @include('dashboard.vistasParciales.navBar') --}}
@section('content')

    <div class="form-group">

        <h1 class="display-1 text-center">Lista de Marcas</h1>
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
                                <td>
                                    @if ($marca->logo)
                                        <img width="50px" height="50px" src="{{ $marca->logo }}">
                                    @else
                                        No hay imagen.
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($marca->deleted_at))
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalBorrado" data-id="{{ $marca->nombre }}">Borrar</button>
                                        <a class="btn btn-primary"
                                            href="{{ route('marcas.edit', $marca->nombre) }}">Editar</a>
                                    @else
                                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalReactivar"
                                            data-id="{{ $marca->nombre }}">Recuperar</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <form action="{{ route('marcas.destroy') }}" method="POST">
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
                        <p>¿Estas seguro que quiere eliminar esta marca?</p>
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
    <form action="{{ route('marcas.reactivar') }}" method="POST">
        @csrf
        <div class="modal fade" id="modalReactivar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro que quiere reactivar esta marca?</p>
                        <input name="nombre" hidden readonly id="nombreMarcaReactivar" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Recuperar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- Pagination --}}
    <div class="d-flex flex-row-reverse">
        {!! $marcas->links() !!}
    </div>
    <script>
        window.onload = function carga() {
            modalEvento();
        }
    </script>
@endsection
