@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1 text-center">Reingreso de orden de servicio</h1>
        <hr>
        <form id="formCrearOrdenDeServicio" action="{{route('admin.ordenDeServicio.altaReingreso')}}" method="POST" >
            @csrf
            <div id="informacionOrden" class="row justify-content-center align-items-center pt-2">
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>Nro orden de servicio</label>
                    <input onchange="ordenDeServicioReingreso(event.target.value)" value="{{ old('nro_orden_anterior') }}" autocomplete="off" type="number" name="nro_orden_anterior" id="nro_orden_anterior" class="form-control {{$errors->has('nro_orden_anterior') ? 'border-danger' : ''}}"  placeholder="Ingresa nro orden de servicio">
                    @if($errors->has('nro_orden_anterior'))
                        <span class="text-danger">{{$errors->first('nro_orden_anterior')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>IMEI</label>
                    <input autocomplete="off" value="{{ old('imei') }}" type="number" name="imei" id="imei" class="form-control {{$errors->has('imei') ? 'border-danger' : ''}}"  placeholder="Ingresa IMEI">
                    @if($errors->has('imei'))
                        <span class="text-danger">{{$errors->first('imei')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>Estado del celular</label>
                    <textarea type="text" name="descripcion_estado_celular" class="form-control {{$errors->has('descripcion_estado_celular') ? 'border-danger' : ''}}" id="descripcion_estado_celular" placeholder="Ingresa descripción de estado del celular">{{old('descripcion_estado_celular')}}</textarea>
                    @if($errors->has('descripcion_estado_celular'))
                        <span class="text-danger">{{$errors->first('descripcion_estado_celular')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>Motivo de la orden</label>
                    <textarea type="text" name="motivo_orden" class="form-control {{$errors->has('motivo_orden') ? 'border-danger' : ''}}" id="motivo_orden" placeholder="Ingresa motivo de la orden">{{old('motivo_orden')}}</textarea>
                    @if($errors->has('motivo_orden'))
                        <span class="text-danger">{{$errors->first('motivo_orden')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <button onclick="enviarFormOrdenDeServicioReingreso()" type="button" class="btn btn-secondary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    @if ($message = Session::get('errors'))
    @endif
@endsection
