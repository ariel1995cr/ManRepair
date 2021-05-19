@extends('layouts.base')

@section('content')


<div class="container">
    <div class="col-12 text-center">
        <h1 class="display-1">Iniciar Sesión</h1>
    </div>
    <form action="{{route('empleado.iniciarSesion.post')}}" method="POST">
        @csrf
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-4 p-4 border border-black rounded">
                    <div class="col-12">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa email">
                        @if($errors->has('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Contraseña</label>
                        <input type="password" name="contrasena" class="form-control {{$errors->has('contrasena') ? 'border-danger' : ''}}" id="contrasena" placeholder="Ingresar contraseña">
                        @if($errors->has('contrasena'))
                            <span class="text-danger">{{$errors->first('contrasena')}}</span>
                        @endif
                    </div>
                <div class="col-12 mt-3 text-center">
                    <button type="submit" class="btn btn-secondary">Acceder</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop
