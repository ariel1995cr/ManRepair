@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">Crear orden de servicio</h1>
        <hr>
        <form>
            @csrf
            <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-4">
                        <label>Marca</label>
                        <select onchange="changeMarca()" id="marca" name="marca" class="form-select" aria-label="Seleccionar marca" {{$errors->has('email') ? 'border-danger' : ''}}>
                            <option selected value="">Seleccionar marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->nombre}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                <div class="col-12 col-md-4">
                    <label>Modelo</label>
                    <select id="modelo" name="modelo" class="form-select" aria-label="Seleccionar modelo" {{$errors->has('email') ? 'border-danger' : ''}}>
                        <option value="" selected>Seleccionar modelo</option>
                    </select>
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-4">
                    <label>IMEI</label>
                    <input type="text" name="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa IMEI">
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-4">
                    <label>DNI cliente</label>
                    <input type="text" name="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa DNI cliente">
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center align-items-center pt-2">
                <div class="col-12 col-md-8">
                    <label>Estado del celular</label>
                    <textarea type="text" name="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa email">
                    </textarea>
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="col-12 col-md-8">
                    <label>Motivo de la orden</label>
                    <textarea type="text" name="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" id="email" placeholder="Ingresa email">
                    </textarea>
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
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
@endsection

