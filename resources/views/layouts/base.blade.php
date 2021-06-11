<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Man Repair</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/index.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/base.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/all.js') }}"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/#">Man Repair</a>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/#">Inicio</a>
                        </li>
                        @guest()
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('empleado.iniciarSesion')}}">Iniciar sesion</a>
                        </li>
                        @endguest
                        @auth()
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index')}}">Dashboard Administrativo</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @if ($message = Session::get('errors'))
            <script>
                let mensaje = @json($message->first());
                enviarNotificacion('error', 'Error en el formulario', `${mensaje}`);
            </script>
        @endif
        @yield('content')
    </div>

</body>

</html>
