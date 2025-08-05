@extends('layouts.header')

@section('content')
<h2>Editar Usuario</h2>
<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="form-group">
        
        <input type="hidden" name="name" class="form-control" value="{{ $usuario->name }}" required>
    </div>
    <div class="form-group">
      
        <input type="hidden" name="email" class="form-control" value="{{ $usuario->email }}" required>
    </div>
    <div class="form-group">
    @foreach($usuario->roles as $role)
    <input type="hidden" name="roles[]" value="{{ $role->id }}">
@endforeach
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
