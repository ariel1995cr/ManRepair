{{--  <form>  --}}
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="txt" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" name="nombre" id="nombre" value="{{$cliente->nombre}}">
        @if($errors->has('nombre'))
            <span class="text-danger">{{$errors->first('nombre')}}</span>
        @endif
    </div>


    <div class="mb-3">
        <label for="logo" class="form-label">Apellido</label>
        <input type="txt" class="form-control {{$errors->has('apellido') ? 'border-danger' : ''}}" name="apellido" id="apellido" value="{{$cliente->apellido}}">
        @if($errors->has('apellido'))
            <span class="text-danger">{{$errors->first('apellido')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">DNI</label>
        <input type="number" class="form-control {{$errors->has('dni') ? 'border-danger' : ''}}" name="dni" id="dni" value="{{$cliente->dni}}">
        @if($errors->has('dni'))
            <span class="text-danger">{{$errors->first('dni')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Número de telefono</label>
        <input type="text" class="form-control {{$errors->has('numero_de_telefono') ? 'border-danger' : ''}}" name="numero_de_telefono" id="numero_de_telefono" value="{{$cliente->numero_de_telefono}}">
        @if($errors->has('numero_de_telefono'))
            <span class="text-danger">{{$errors->first('numero_de_telefono')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Email</label>
        <input type="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" name="email" id="email" value="{{$cliente->email}}">
        @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
        @endif
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

{{--  </form>  --}}
