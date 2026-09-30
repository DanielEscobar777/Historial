<?php

namespace App\Http\Controllers;

use App\Models\Impresion_diagnostica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Impresion_diagnosticaController extends Controller
{
    public function update(Request $request, $id_impresion_diagnostica )
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'impresion_diagnostica'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Impresion_diagnostica::findOrFail($id_impresion_diagnostica);

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
