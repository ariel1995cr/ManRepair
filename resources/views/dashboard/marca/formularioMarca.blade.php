    <form>
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="txt" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" name="nombre" id="nombre" value="{{$marca->nombre}}">
            @if($errors->has('nombre'))
                <span class="text-danger">{{$errors->first('nombre')}}</span>
            @endif
        </div>

        {{-- Carga del Logo con alguna implementacion que conoscan --}}
        <div class="mb-3">
            <input type="file" name="logo" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Logo</label>
            @if($errors->has('logo'))
                <span class="text-danger">{{$errors->first('logo')}}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>
