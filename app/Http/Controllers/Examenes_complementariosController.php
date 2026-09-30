<?php

namespace App\Http\Controllers;

use App\Models\Examenes_complementarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examenes_complementariosController extends Controller
{
    public function update(Request $request, $id_examenes_complementarios )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'examenes_complementarios'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examenes_complementarios::findOrFail($id_examenes_complementarios);

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
