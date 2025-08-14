<?php

namespace App\Http\Controllers;

use App\Models\historia_enfermedad_actual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historia_enfermedad_actualController extends Controller
{
    public function update(Request $request, $id_historia_enfermedad )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'historia_de_enfermedad_actual'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = historia_enfermedad_actual::findOrFail($id_historia_enfermedad);

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
