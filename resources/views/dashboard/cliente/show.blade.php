@extends('layouts.baseAdmin')


@section('content')

    <div class="form-group">

        <h1 class="display-1 text-center">Lista de Clientes</h1>
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
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->apellido }}</td>
                                <td scope="row">{{ $cliente->dni }}</td>
                                <td>{{ $cliente->numero_de_telefono }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('clientes.edit', $cliente->dni) }}">Editar</a>

                                    {{-- <!-- Button trigger modal --> --}}
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-bs-whatever="{{ $cliente->dni }}">Cerrar</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{-- Modal --}}
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">New message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Seguro que desea borrar el Modelo seleccionado?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                {{--  Boton formulario  --}}
                                <form id="formularioDeBorrado" action="{{ route('clientes.destroy', 0) }}"
                                    data-action="{{ route('clientes.destroy', 0) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal --}}
            </div>
        </div>
    </div>

    <script>
        var deleteModal = document.getElementById('deleteModal')
        deleteModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            console.log("Modal abierto");
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var id = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = deleteModal.querySelector('.modal-title')

            modalTitle.textContent = 'Deseas Borrar el cliente DNI: ' + id + ' ?'
        })
    </script>

@endsection
