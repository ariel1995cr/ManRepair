@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1  text-center">Crear orden de servicio</h1>
        <hr>
        <form id="formCrearOrdenDeServicio" action="{{route('ordenDeServicio.store')}}" method="POST" >
            @csrf
            <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-4">
                        <label>Marca</label>
                        <select onchange="changeMarca(event.target.value)" id="marca" name="marca" class="form-select {{$errors->has('marca') ? 'border-danger' : ''}}" aria-label="Seleccionar marca">
                            <option selected value="">Seleccionar marca</option>
                            @foreach($marcas as $marca)
                                <option {{ old('marca') == $marca->nombre ? 'selected' : '' }} value="{{$marca->nombre}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('marca'))
                            <span class="text-danger">{{$errors->first('marca')}}</span>
                        @endif
                    </div>
                <div class="col-12 col-md-4">
                    <label>Modelo</label>
                    <select id="modelo" name="modelo" class="form-select {{$errors->has('modelo') ? 'border-danger' : ''}}" aria-label="Seleccionar modelo">
                        <option value="" selected>Seleccionar modelo</option>
                    </select>
                    @if($errors->has('modelo'))
                        <span class="text-danger">{{$errors->first('modelo')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>IMEI</label>
                    <input type="number" value="{{ old('imei') }}" name="imei" class="form-control {{$errors->has('imei') ? 'border-danger' : ''}}" id="imei" placeholder="Ingresa IMEI">
                    @if($errors->has('imei'))
                        <span class="text-danger">{{$errors->first('imei')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-4">
                    <label>DNI cliente</label>
                    <input onchange="changeDNICliente(event.target.value)" value="{{ old('dni') }}" type="text" name="dni" class="form-control {{$errors->has('dni') ? 'border-danger' : ''}}" id="dni" placeholder="Ingresa DNI cliente">
                    @if($errors->has('dni'))
                        <span class="text-danger">{{$errors->first('dni')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>Email cliente</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa email" readonly>
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-4">
                    <label>Nombre cliente</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" id="nombre" placeholder="Ingresa nombre" readonly>
                    @if($errors->has('nombre'))
                        <span class="text-danger">{{$errors->first('nombre')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>Apellido cliente</label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" class="form-control {{$errors->has('apellido') ? 'border-danger' : ''}}" id="apellido" placeholder="Ingresa apellido" readonly>
                    @if($errors->has('apellido'))
                        <span class="text-danger">{{$errors->first('apellido')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-4">
                    <label>Telefono cliente</label>
                    <input type="text" name="numero_de_telefono" value="{{ old('numero_de_telefono') }}" class="form-control {{$errors->has('numero_de_telefono') ? 'border-danger' : ''}}" id="telefono" placeholder="Ingresa telefono sin el 0 y sin el 15" readonly>
                    @if($errors->has('numero_de_telefono'))
                        <span class="text-danger">{{$errors->first('numero_de_telefono')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-8">
                    <label>Estado del celular</label>
                    <textarea type="text" name="estado" class="form-control {{$errors->has('estado') ? 'border-danger' : ''}}" id="estado">{{ old('estado') }}</textarea>
                    @if($errors->has('estado'))
                        <span class="text-danger">{{$errors->first('estado')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-8">
                    <label>Motivo de la orden</label>
                    <textarea type="text" name="motivo_orden" class="form-control {{$errors->has('motivo_orden') ? 'border-danger' : ''}}" id="motivo_orden">{{ old('motivo_orden') }}</textarea>
                    @if($errors->has('motivo_orden'))
                        <span class="text-danger">{{$errors->first('motivo_orden')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center pt-2">
                <div class="col-12 col-md-8">
                    <button type="submit" class="btn btn-secondary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    @if ($message = Session::get('errors'))
        <script>
            let marca = @json(old('marca'));
            let modelo = @json(old('modelo'));
            if(marca != ''){
                obtenerModelos(marca,modelo)
            }
            let dni = document.getElementById('dni').value;
            if(dni != ''){
                changeDNICliente(dni)
            }
        </script>
    @endif
@endsection
