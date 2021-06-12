@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1">Modificar Estado Orden De Servicio - {{$ordenDeServicio->nro}}</h1>
        <hr>
        <form id="formCambiarEstado" action="{{route('admin.ordenDeServicio.cambiarEstado.Post', ['nroOrdenDeServicio'=>$ordenDeServicio->nro])}}" method="POST" >
            @csrf
            <div id="divForm" class="row justify-content-center align-items-center">
                <div class="row">
                    <div class="col-12 col-md-4 mx-auto">
                        <p>Estado Actual: {{$ordenDeServicio->estado_actual}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Nuevo Estado</label>
                        <select onchange="formularioCambioDeEstado(event.target.value)" class="form-select" id="nombre_estado" name="nombre_estado">
                            <option value="">Seleccionar estado</option>
                            @foreach($estadosPosibles as $estado)
                                <option {{ old('nombre_estado') == $estado->nombre ? 'selected' : '' }} value="{{$estado->nombre}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Detalle de reparación</label>
                        <textarea name="detalle_reparacion" class="form-control {{$errors->has('detalle_reparacion') ? 'border-danger' : ''}}" id="detalle_reparacion">{{ trim(old('detalle_reparacion')) }}</textarea>
                        @if($errors->has('detalle_reparacion'))
                            <span class="text-danger">{{$errors->first('detalle_reparacion')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Materiales necesarios</label>
                        <textarea name="materiales_necesarios" class="form-control {{$errors->has('materiales_necesarios') ? 'border-danger' : ''}}" id="materiales_necesarios">{{ trim(old('materiales_necesarios')) }}</textarea>
                        @if($errors->has('materiales_necesarios'))
                            <span class="text-danger">{{$errors->first('materiales_necesarios')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Importe de reparación</label>
                        <input type="text" name="importe_reparacion" value="{{ old('importe_reparacion') }}" class="form-control {{$errors->has('importe_reparacion') ? 'border-danger' : ''}}" id="importe_reparacion" placeholder="" />
                        @if($errors->has('importe_reparacion'))
                            <span class="text-danger">{{$errors->first('importe_reparacion')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Tiempo de reparación</label>
                        <input type="date" name="tiempo_de_reparacion" value="{{ old('tiempo_de_reparacion') }}" class="form-control {{$errors->has('tiempo_de_reparacion') ? 'border-danger' : ''}}" id="tiempo_de_reparacion" placeholder="" />
                        @if($errors->has('tiempo_de_reparacion'))
                            <span class="text-danger">{{$errors->first('tiempo_de_reparacion')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row d-none" id="comentario">
                    <div class="col-12 col-md-4 mx-auto">
                        <label>Comentario</label>
                        <textarea name="comentario" class="form-control {{$errors->has('comentario') ? 'border-danger' : ''}}" id="comentario">{{ trim(old('comentario')) }}</textarea>
                        @if($errors->has('comentario'))
                            <span class="text-danger">{{$errors->first('comentario')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row d-none" id="guardar">
                    <div class="col-12 col-md-4 mx-auto mt-2">
                       <button type="submit" class="btn btn-secondary">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
        @if ($message = Session::get('errors'))
            <script>
                let nombre_estado = @json(old('nombre_estado'));
                formularioCambioDeEstado(nombre_estado)
            </script>
        @endif
    </div>
@endsection
