<form>
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="txt" class="form-control" name="nombre" id="nombre" value="{{$cliente->nombre}}">
    </div>

    
    <div class="mb-3">
        <label for="logo" class="form-label">Apellido</label>
        <input type="txt" class="form-control" name="apellido" id="apellido" value="{{$cliente->apellido}}">
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">DNI</label>
        <input type="number" class="form-control" name="dni" id="dni" value="{{$cliente->dni}}"> 
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Número de telefono</label>
        <input type="text" class="form-control" name="numero_de_telefono" id="numero_de_telefono" value="{{$cliente->numero_de_telefono}}">
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{$cliente->email}}">
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>