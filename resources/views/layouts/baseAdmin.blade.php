<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Man Repair</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/index.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/base.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    @stack('head')
</head>

<body>
<main>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Man Repair</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
            </a>
        </li>
        {{-- // Clientes //  --}}
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#home-collapseCliente" aria-expanded="false">
                Clientes
            </button>
            <div class="collapse" id="home-collapseCliente">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('clientes.create')}}" class="link-dark text-white rounded">Crear</a></li>
                    <li><a href="{{route('clientes.index')}}" class="link-dark text-white rounded">Listar</a></li>

                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                Ordenes de servicio
            </button>
            <div class="collapse" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('ordenDeServicio.create')}}" class="link-dark text-white rounded">Crear</a></li>
                    <li><a href="{{route('admin.ordenDeServicio.listar')}}" class="link-dark text-white rounded">Listar</a></li>
                    <li><a href="{{route('admin.ordenDeServicio.reingreso.view')}}" class="link-dark text-white rounded">Crear Reingreso</a></li>
                </ul>
            </div>
        </li>
        {{-- // Marca //  --}}
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#home-collapseMarca" aria-expanded="false">
                Marcas
            </button>
            <div class="collapse" id="home-collapseMarca">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('marcas.create')}}" class="link-dark text-white rounded">Crear</a></li>
                    <li><a href="{{route('marcas.index')}}" class="link-dark text-white rounded">Listar</a></li>

                </ul>
            </div>
        </li>
        {{-- // Modelo //  --}}
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#home-collapseModelo" aria-expanded="false">
                Modelos
            </button>
            <div class="collapse" id="home-collapseModelo">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('modelos.create')}}" class="link-dark text-white rounded">Crear</a></li>
                    <li><a href="{{route('modelos.index')}}" class="link-dark text-white rounded">Listar</a></li>

                </ul>
            </div>
        </li>
        {{-- // Empleados //  --}}
        @if(Auth::user()->rol == 1)
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#home-collapseEmpleado" aria-expanded="false">
                    Empleados
                </button>
                <div class="collapse" id="home-collapseEmpleado">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{route('empleados.create')}}" class="link-dark text-white rounded">Crear</a></li>
                        <li><a href="{{route('empleados.index')}}" class="link-dark text-white rounded">Listar</a></li>

                    </ul>
                </div>
            </li>
        @endauth

        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed text-white mt-2" data-bs-toggle="collapse" data-bs-target="#reporte-collapse" aria-expanded="false">
                Reportes
            </button>
            <div class="collapse" id="reporte-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('admin.reportes.generarView')}}" class="link-dark text-white rounded">Generar</a></li>
                </ul>
            </div>
        </li>
    </ul>


    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{Auth::user()->apellido}} {{Auth::user()->nombre}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{route('admin.empleado.cambiarContraseña')}}">Cambiar contraseña</a></li>
            <li><a class="dropdown-item" href="{{route('admin.cerrarSesion')}}">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>
    <div class="container-fluid" style="overflow-y: scroll">
        @if($errors->has('message'))
            <script>
                let mensaje = @json($errors->get('message')[0]);
                enviarNotificacion('error', 'Error en el formulario', `${mensaje}`);
            </script>
        @endif
            @if ($status = Session::get('status'))
                <script>
                    let mensaje = @json($status);
                    enviarNotificacion('success', '', `${mensaje}`);
                </script>
            @endif
        @yield('content')
    </div>
</main>
</body>

</html>
