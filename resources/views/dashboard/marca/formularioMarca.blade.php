    <form>
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="txt" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" name="nombre" id="nombre" value="{{ old('nombre') == '' ? $marca->nombre : old('nombre') }}">
            @if($errors->has('nombre'))
                <span class="text-danger">{{$errors->first('nombre')}}</span>
            @endif
        </div>
        @if($marca->logo != null)
            <div class="form-check mb-3">
                <input onchange="eliminarFoto(event.target)" class="form-check-input" type="checkbox" name="eliminarFotoValue" id="eliminarFotoValue">
                <label class="form-check-label" for="eliminarFotoValue">
                    Eliminar foto
                </label>
            </div>
        @endif
        {{-- Carga del Logo con alguna implementacion que conoscan --}}
        <div id="CambiarFoto" class="mb-3">
            <input type="file" name="logo" class="custom-file-input" id="chooseFile" value="{{ old('logo') == '' ? $marca->logo : old('logo') }}">
            <label class="custom-file-label" for="chooseFile">Logo</label>
            @if($errors->has('logo'))
                <span class="text-danger">{{$errors->first('logo')}}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>
