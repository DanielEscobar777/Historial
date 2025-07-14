<?php

namespace App\Http\Controllers;

use App\Models\Ganglios_linfaticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ganglios_linfaticosController extends Controller
{
    public function update(Request $request, $id_ganglios)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'ganglios_linfaticos',
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Ganglios_linfaticos::findOrFail($id_ganglios);

        // Preparar datos para actualización
        $updateData = ['id_usuario' => $userId];

        // Solo actualizar los campos que vinieron en el request
        foreach ($validated as $field => $value) {
            $updateData[$field] = $value;
        }

        // Realizar la actualización
        $antecedentes->update($updateData);

        return redirect()->back()->with('success', 'Historia actualizada correctamente.');
    }
}
