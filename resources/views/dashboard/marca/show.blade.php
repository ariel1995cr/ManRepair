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

                                    <a class="btn btn-primary"
                                        href="{{ route('marcas.edit', $marca->nombre) }}">Editar</a>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrado"  data-id="{{$marca->nombre}}">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <form action="" method="">
        <div class="modal fade" id="modalBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro que quiere eliminar esta marca?</p>
                        <input id="nombreMarca" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger">Borrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script>
    window.onload = function carga(){
        modalEvento();
    }
</script>
@endsection
