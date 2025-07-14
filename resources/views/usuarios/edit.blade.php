@extends('layouts.header')

@section('content')
<h2>Editar Usuario</h2>
<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="{{ $usuario->email }}" required>
    </div>
    <div class="form-group">
        <label>Roles</label>
        <select name="roles[]" class="form-control select2" multiple>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $usuario->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Servicios</label>
        <select name="servicios[]" class="form-control select2" multiple>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id_servicio }}"
                    {{ $usuario->servicios->contains('id_servicio', $servicio->id_servicio) ? 'selected' : '' }}>
                    {{ $servicio->nombre_servicio }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
