<form>
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="txt" class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" name="nombre" id="nombre" value="{{ old('nombre') == '' ? $empleado->nombre : old('nombre') }}">
        @if($errors->has('nombre'))
            <span class="text-danger">{{$errors->first('nombre')}}</span>
        @endif
    </div>


    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="txt" class="form-control {{$errors->has('apellido') ? 'border-danger' : ''}}" name="apellido" id="apellido" value="{{ old('apellido') == '' ? $empleado->apellido : old('apellido') }}">
        @if($errors->has('apellido'))
            <span class="text-danger">{{$errors->first('apellido')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="number" class="form-control {{$errors->has('dni') ? 'border-danger' : ''}}" name="dni" id="dni" value="{{ old('dni') == '' ? $empleado->dni : old('dni') }}">
        @if($errors->has('dni'))
            <span class="text-danger">{{$errors->first('dni')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="numero_de_telefono" class="form-label">Número de telefono</label>
        <input type="text" class="form-control {{$errors->has('numero_de_telefono') ? 'border-danger' : ''}}" name="numero_de_telefono" id="numero_de_telefono" value="{{ old('numero_de_telefono') == '' ? $empleado->numero_de_telefono : old('numero_de_telefono') }}">
        @if($errors->has('numero_de_telefono'))
            <span class="text-danger">{{$errors->first('numero_de_telefono')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control {{$errors->has('email') ? 'border-danger' : ''}}" name="email" id="email" value="{{ old('email') == '' ? $empleado->email : old('email') }}">
        @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select id="rol" name="rol" class="form-select {{$errors->has('rol') ? 'border-danger' : ''}}" aria-label="Seleccionar rol">
            <option  value="">Seleccionar rol</option>
            <option {{ $empleado->rol == 1 ? 'selected' : '' }} {{ old('rol') == 1 ? 'selected' : '' }} value="1">Administrador</option>
            <option {{ $empleado->rol == 2 ? 'selected' : '' }} {{ old('rol') == 2 ? 'selected' : '' }} value="2">Empleado</option>
        </select>
        @if($errors->has('rol'))
            <span class="text-danger">{{$errors->first('rol')}}</span>
        @endif
    </div>


    <div class="mb-3">
        <label for="contrasena" class="form-label {{$errors->has('contrasena') ? 'border-danger' : ''}}">Contraseña</label>
        <input class="form-control" type="password" name="contrasena" id="contrasena" />
        @if($errors->has('contrasena'))
            <span class="text-danger">{{$errors->first('contrasena')}}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="contrasena_confirmation" class="form-label {{$errors->has('contrasena_confirmation') ? 'border-danger' : ''}}">Confirmar contraseña</label>
        <input type="password" class="form-control" name="contrasena_confirmation" id="contrasena_confirmation">
        @if($errors->has('contrasena_confirmation'))
            <span class="text-danger">{{$errors->first('contrasena_confirmation')}}</span>
        @endif
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>
