<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Servicio;

class UsuarioController extends Controller
{
    public function index() {
        
        $usuarios = User::with('roles')->get();
         if (!auth()->user()->hasRole('Jefe de enseñanza')) {
        abort(403, 'Acceso no autorizado');
    }
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all(); // ya está en tu vista
        $servicios = Servicio::all(); // asegúrate de que tienes este modelo
    
        return view('usuarios.create', compact('roles', 'servicios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Asignar roles
        $user->roles()->sync($request->roles);

        // Asignar servicios seleccionados (muchos a muchos)
        if ($request->has('servicios')) {
            $user->servicios()->sync($request->servicios);
        }

        // Si se quiere agregar un nuevo servicio además de los seleccionados
        if ($request->filled('nombre_servicio')) {
            $nuevoServicio = Servicio::create([
                'nombre_servicio' => $request->nombre_servicio,
                'id_usuario' => $user->id, // si deseas relacionarlo como creador
            ]);
            // Añadir el nuevo servicio a la relación muchos a muchos
            $user->servicios()->attach($nuevoServicio->id_servicio);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }


    public function edit($id)
    {
        $usuario = User::with('roles', 'servicios')->findOrFail($id);
        $roles = Role::all();
        $servicios = Servicio::all();

        return view('usuarios.edit', compact('usuario', 'roles', 'servicios'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();

        // Sincronizar roles correctamente
        $usuario->roles()->sync($request->roles);

        // Sincronizar servicios si existen
        if ($request->has('servicios')) {
            $usuario->servicios()->sync($request->servicios);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Puedes agregar una condición para evitar que se borre el usuario actual, si quieres
        if ($user->id == auth()->id()) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
