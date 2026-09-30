<?php

namespace App\Http\Controllers;

use App\Models\Sistema_motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sistema_motorController extends Controller
{
    public function update(Request $request, $id_sistema_motor)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'tono',
                'trofismo',
                'reflejos_de_estiramiento',
                'balance_muscular_brazo_derecho',
                'balance_muscular_brazo_izquierdo',
                'balance_muscular_antebrazo_derecho',
                'balance_muscular_antebrazo_izquierdo',
                'balance_muscular_mano_derecho',
                'balance_muscular_mano_izquierdo',
                'balance_muscular_muslo_derecho',
                'balance_muscular_muslo_izquierdo',
                'balance_muscular_pierna_derecho',
                'balance_muscular_pierna_izquierdo',
                'balance_muscular_pie_derecho',
                'balance_muscular_pie_izquierdo'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Sistema_motor::findOrFail($id_sistema_motor);

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
