@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1 text-center">Cambiar contraseña</h1>
        <hr>
        <form id="formCrearOrdenDeServicio" action="{{route('admin.empleado.cambiarContraseñaPost')}}" method="POST" >
            @csrf
            <div class="row justify-content-center align-items-center pt-2">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4">
                        <label>Contraseña actual</label>
                        <input value="{{ old('contrasena') }}" autocomplete="off" type="password" name="contrasena" id="contrasena" class="form-control {{$errors->has('contrasena') ? 'border-danger' : ''}}"  placeholder="Ingresa contraseña actual">
                        @if($errors->has('contrasena'))
                            <span class="text-danger">{{$errors->first('contrasena')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4">
                        <label>Contraseña nueva</label>
                        <input value="{{ old('contrasenaNueva') }}" autocomplete="off" type="password" name="contrasenaNueva" id="contrasenaNueva" class="form-control {{$errors->has('contrasenaNueva') ? 'border-danger' : ''}}"  placeholder="Ingresa contraseña nueva">
                        @if($errors->has('contrasenaNueva'))
                            <span class="text-danger">{{$errors->first('contrasenaNueva')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4">
                        <label>Confirmar contraseña nueva</label>
                        <input value="{{ old('contrasenaNueva_confirmation') }}" autocomplete="off" type="password" name="contrasenaNueva_confirmation" id="contrasenaNueva_confirmation" class="form-control {{$errors->has('contrasenaNueva_confirmation') ? 'border-danger' : ''}}"  placeholder="Repita la contraseña nueva">
                        @if($errors->has('contrasenaNueva_confirmation'))
                            <span class="text-danger">{{$errors->first('contrasenaNueva_confirmation')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row justify-content-center pt-2 ">
                    <div class="col-12 col-md-4">
                        <button type="submit" class="btn btn-secondary">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
