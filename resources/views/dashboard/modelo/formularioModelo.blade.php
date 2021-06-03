<form>
    @csrf

     {{-- Carga del Logo con alguna implementacion que conoscan --}}
     <div class="mb-3">
        <label for="Modelo" class="form-label">Marca</label>
        <input type="txt" class="form-control" name="nombre_marca" id="modelo">
    </div>

    <div class="mb-3">
        <label for="Nombre" class="form-label">Modelo</label>
        <input type="txt" class="form-control" name="nombre" id="nombre">
    </div>

    <div class="mb-3">
        <label for="Fecha de lanzamiento" class="form-label">Fecha de lanzamiento</label>
        <input type="date" class="form-control" name="fecha_lanzamiento" id="lanzamiento">
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="txt" class="form-control" name="foto" id="foto">
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>