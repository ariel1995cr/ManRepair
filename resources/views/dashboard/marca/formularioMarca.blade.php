    <form>
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="txt" class="form-control" name="nombre" id="nombre">
        </div>

        {{-- Carga del Logo con alguna implementacion que conoscan --}}
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="txt" class="form-control" name="logo" id="logo">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>