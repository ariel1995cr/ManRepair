@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1  text-center">Generar reporte</h1>
        <hr>
        <form id="formCrearOrdenDeServicio" action="{{route('admin.reportes.generarReporteDeServicio')}}" method="POST">
            @csrf
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <label>Seleccionar tipo de reporte</label>
                    <div class="btn-group w-100 {{$errors->has('tipo_reporte') ? 'border-danger' : ''}}" role="group" aria-label="Basic radio toggle button group">
                        <input onchange="formularioTipoDeReporte(event.target.value)" type="radio" class="btn-check " name="tipo_reporte" id="btnradio1" autocomplete="off" value="reporte de servicio">
                        <label class="btn btn-secondary" for="btnradio1">Reporte de servicio</label>

                        <input onchange="formularioTipoDeReporte(event.target.value)" type="radio" class="btn-check" name="tipo_reporte" id="btnradio2" autocomplete="off" value="cantidad de reparados">
                        <label class="btn btn-secondary" for="btnradio2">Cantidad de reparados</label>

                        <input onchange="formularioTipoDeReporte(event.target.value)" type="radio" class="btn-check" name="tipo_reporte" id="btnradio3" autocomplete="off" value="reparados por garantia del celular">
                        <label class="btn btn-secondary" for="btnradio3">Reparados por garantía del célular</label>
                    </div>
                </div>
            </div>
                <div id="todos" class="d-none row justify-content-center align-items-center mt-2">
                    <div class="col-12 col-md-3">
                        <label>Fecha desde</label>
                        <input type="date" name="fechaDesde" value="{{old('fechaDesde')}}" class="form-control {{$errors->has('fechaDesde') ? 'border-danger' : ''}}" id="fechaDesde" placeholder="Ingresa fecha">
                        @if($errors->has('fechaDesde'))
                            <span class="text-danger">{{$errors->first('fechaDesde')}}</span>
                        @endif
                    </div>
                    <div class="col-12 col-md-3">
                        <label>Fecha hasta</label>
                        <input type="date" name="fechaHasta" value="{{old('fechaHasta')}}" class="form-control {{$errors->has('fechaHasta') ? 'border-danger' : ''}}" id="fechaHasta" placeholder="Ingresa fecha">
                        @if($errors->has('fechaHasta'))
                            <span class="text-danger">{{$errors->first('fechaHasta')}}</span>
                        @endif
                    </div>
                </div>
                <div id="selectSeleccionarMarca" class="d-none row align-items-start mt-2">
                    <div class="col-12 col-md-3 offset-md-3">
                        <label>Seleccionar marca</label>
                        <select id="marca" name="marca" class="form-select {{$errors->has('marca') ? 'border-danger' : ''}}" aria-label="Seleccionar marca">
                            <option selected value="">Seleccionar marca</option>
                            <option value="todos">Todos</option>
                            @foreach($marcas as $marca)
                                <option {{ old('marca') == $marca->nombre ? 'selected' : '' }} value="{{$marca->nombre}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('marca'))
                            <span class="text-danger">{{$errors->first('marca')}}</span>
                        @endif
                    </div>
                </div>
                <div id="selectSeleccionarEstado" class="d-none row align-items-start mt-2">
                    <div class="col-12 col-md-3 offset-md-3">
                        <label>Estado</label>
                        <select id="estado" name="estado" class="form-select {{$errors->has('estado') ? 'border-danger' : ''}}" aria-label="Seleccionar estado">
                            <option selected value="">Seleccionar estado</option>
                            <option value="todos">Todos</option>
                            @foreach($estados as $estado)
                                <option {{ old('estado') == $estado->nombre ? 'selected' : '' }} value="{{$estado->nombre}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('estado'))
                            <span class="text-danger">{{$errors->first('estado')}}</span>
                        @endif
                    </div>
                </div>
            <div id="BotonGenerar" class="d-none row align-items-start mt-3">
                <div class="col-12 col-md-3 offset-md-3">
                    <button type="submit" class="btn btn-secondary">Generar</button>
                </div>
            </div>
        </form>
    </div>
    @if ($message = Session::get('errors'))
        <script>
            let tipo_reporte = @json(old('tipo_reporte'));
            formularioTipoDeReporte(tipo_reporte);
        </script>
    @endif
@endsection
