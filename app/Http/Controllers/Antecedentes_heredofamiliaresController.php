<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_heredofamiliares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_heredofamiliaresController extends Controller
{
    public function update(Request $request, $id_antecedentes_heredofamiliares)
    {
        $userId = Auth::id();

        // Crear reglas de validación dinámicas
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['padre', 'madre', 'hermanos', 'esposo', 'hijos', 'abuelos'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Antecedentes_heredofamiliares::findOrFail($id_antecedentes_heredofamiliares);

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
