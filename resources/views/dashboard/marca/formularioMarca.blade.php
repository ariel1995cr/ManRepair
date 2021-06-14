    <form>
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="txt" class="form-control" name="nombre" id="nombre" value="{{$marca->nombre}}">
        </div>

        {{-- Carga del Logo con alguna implementacion que conoscan --}}
        <div class="mb-3">
            <input type="file" name="logo" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Logo</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>
