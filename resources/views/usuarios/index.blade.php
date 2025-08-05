@extends('layouts.header')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Usuarios</h2>
        <!--<a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo Usuario</a>-->
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
            <thead style="background-color: #c5cacf;">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->roles->pluck('name')->join(', ') }}</td>
                    <td class="text-center">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');" class="d-inline">
                            <!-- @csrf @method('DELETE') -->
                            <!--<button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>-->
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
