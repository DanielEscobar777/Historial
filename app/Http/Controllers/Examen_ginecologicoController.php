<?php

namespace App\Http\Controllers;

use App\Models\Examen_ginecologico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examen_ginecologicoController extends Controller
{
    public function update(Request $request, $id_examen_ginecologico)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'vello_pubiano',
                'vulva',
                'uretra',
                'glandulas_ByS',
                'clitoris',
                'perineo',
                'vagina',
                'cuello_uterino',
                'cuerpo_uterino',
                'anexos',
                'especuloscopia',
                'tacto_rectal'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Examen_ginecologico::findOrFail($id_examen_ginecologico);

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
