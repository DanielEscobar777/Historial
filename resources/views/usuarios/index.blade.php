@extends('layouts.header')

@section('content')
<h2>Lista de Usuarios</h2>
<a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo Usuario</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->roles->pluck('name')->join(', ') }}</td>
            <td>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
