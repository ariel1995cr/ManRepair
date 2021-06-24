{{--  <form>  --}}
    @csrf
    <div class="mb-3">
        <label for="Modelo" class="form-label">Marca</label>
        <select onchange="changeMarca(event.target.value)" id="marca" name="nombre_marca" class="form-select {{$errors->has('nombre_marca') ? 'border-danger' : ''}}" aria-label="Seleccionar marca">
            <option selected value="">Seleccionar marca</option>
            @foreach($marcas as $marca)
                <option {{ $marca->nombre == $modelo->nombre_marca ? 'selected' : '' }} value="{{ old('nombre_marca') == '' ? $marca->nombre : old('nombre_marca') }}">{{ old('nombre_marca') == '' ? $marca->nombre : old('nombre_marca') }}</option>
            @endforeach
        </select>
        @if($errors->has('nombre_marca'))
            <span class="text-danger">{{$errors->first('nombre_marca')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="Nombre" class="form-label">Modelo</label>
        <input type="txt" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" name="nombre" id="nombre" value="{{ old('nombre') == '' ? $modelo->nombre : old('nombre') }}">
        @if($errors->has('nombre'))
            <span class="text-danger">{{$errors->first('nombre')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="Fecha de lanzamiento" class="form-label">Fecha de lanzamiento</label>
        <input type="date" class="form-control" name="fecha_lanzamiento" id="lanzamiento" value="{{ old('fecha_lanzamiento') == '' ? $modelo->fecha_lanzamiento : old('fecha_lanzamiento') }}">
    </div>

    <div class="mb-3">
        <input type="file" name="imagen" class="custom-file-input" id="chooseFile">
        <label class="custom-file-label" for="chooseFile">Imagen</label>
        <br>
        @if($errors->has('imagen'))
            <span class="text-danger">{{$errors->first('imagen')}}</span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

{{--  </form>  --}}
