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

                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalBorrado" data-id="">Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                            <input type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    /// END
                </table>

            </div>
        </div>

    </div>

@endsection
