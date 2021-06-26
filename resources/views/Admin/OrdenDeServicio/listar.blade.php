@extends('layouts.baseAdmin')

@section('content')
    <div class="col-12 text-left">
        <h1 class="display-1 text-center">Listado de ordenes de servicio</h1>
        <hr>
        <form action="{{route('admin.ordenDeServicio.listar')}}" method="get">
       <div class="row justify-content-end">
               <div class="col-12 col-md-2">
                   <select name="campoBusqueda" class="form-select form-select-sm" aria-label=".form-select-sm example">
                       <option {{ old('campoBusqueda') == "" ? 'selected' : '' }} value="" selected>Seleccionar campo</option>
                       <option {{ old('campoBusqueda') == "nro" ? 'selected' : '' }} value="nro">Nro</option>
                       <option {{ old('campoBusqueda') == "imei" ? 'selected' : '' }} value="imei">IMEI</option>
                       <option {{ old('campoBusqueda') == "nombre_marca" ? 'selected' : '' }} value="nombre_marca">Marca</option>
                       <option {{ old('campoBusqueda') == "nombre_modelo" ? 'selected' : '' }} value="nombre_modelo">Modelo</option>
                       <option {{ old('campoBusqueda') == "nombre" ? 'selected' : '' }} value="nombre">Cliente</option>
                       <option {{ old('campoBusqueda') == "created_at" ? 'selected' : '' }} value="created_at">Fecha de ingreso</option>
                       <option {{ old('campoBusqueda') == "nombre_estado" ? 'selected' : '' }} value="nombre_estado">Estado actual</option>
                   </select>
               </div>
               <div class="col-12 col-md-2">
                   <input value="{{old('valorBusqueda')}}" name="valorBusqueda" type="text" class="form-control form-control-sm" placeholder="Valor de busqueda" aria-label="Valor a buscar">
                   @if($errors->has('valorBusqueda'))
                       <span class="text-danger">{{$errors->first('valorBusqueda')}}</span>
                   @endif
               </div>
               <div class="col-12 col-md-1">
                   <button type="submit" class="btn btn-sm btn-secondary">Buscar</button>
               </div>
       </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>Nro</th>
                <th>Motivo orden</th>
                <th>IMEI</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cliente</th>
                <th>Atendido por</th>
                <th>Ingreso</th>
                <th>Estado actual</th>
                <th>Ultima actualizaci&oacute;n</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ordenesDeServicios as $orden)
                <tr>
                    <th>{{$orden->nro}}</th>
                    <td>{{$orden->motivo_orden}}</td>
                    <td>{{$orden->celular->imei}}</td>
                    <td>{{$orden->celular->nombre_marca}}</td>
                    <td>{{$orden->celular->nombre_modelo}}</td>
                    <td>{{$orden->cliente->apellido}} {{$orden->cliente->nombre}}</td>
                    <td>{{$orden->empleado->apellido}} {{$orden->empleado->nombre}}</td>
                    <td>{{$orden->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{$orden->estado_actual}}</td>
                    <td>{{$orden->ultima_actualizacion->format('d/m/Y H:i')}}</td>
                    <td>
                        @if($orden->estado_actual != 'Entregado')
                            <a href="{{route('admin.ordenDeServicio.cambiarEstado', ['nroOrdenDeServicio'=>$orden->nro])}}" class="text-black-50" data-bs-toggle="tooltip" data-bs-placement="left" title="Cambiar estado">
                                <button class="botonTransparente" type="submit">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </a>
                        @endif
                            <a href="{{route('admin.ordenDeServicio.ver', ['nroOrdenDeServicio'=>$orden->nro])}}" class="text-black-50" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver orden de servicio">
                                <button class="botonTransparente" type="submit">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="float-end mx-4">
            {{ $ordenesDeServicios->links() }}
        </div>
    </div>
@endsection
