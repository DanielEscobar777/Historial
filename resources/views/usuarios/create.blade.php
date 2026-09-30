@extends('layouts.header')

@section('content')
<h2>Crear Usuario</h2>
<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Roles</label>
        <select name="roles[]" class="form-control select2" multiple>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Servicios</label>
        <select name="servicios[]" class="form-control select2" multiple>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id_servicio }}">{{ $servicio->nombre_servicio }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@endsection
