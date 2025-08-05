<?php

namespace App\Http\Controllers;

use App\Models\Antecedentes_no_patologicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Antecedentes_no_patologicosController extends Controller
{
    public function update(Request $request, $id_antecedentes_nopatologicos)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];

        // Solo validar los campos que vienen en el request
        foreach (['vacunas', 'vacunas_hpv', 'habitos_toxicos', 'alimentacion', 'habito_miccional', 'habito_intestinal','vivienda_servicio_basico',
        'habito_alcoholico','habito_tabaquico', 'exposicion_biomasa', 'contacto_con_tuberculosis','contacto_triatoma_infestans','toxicomanias_drogas',
        'nmunizaciones','antecedentes_sexuales','inmunizaciones'] as $field) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string|max:255';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }

        // Validar solo los campos presentes
        $validated = $request->validate($rules, $messages);

        // Obtener el registro a actualizar
        $antecedentes = Antecedentes_no_patologicos::findOrFail($id_antecedentes_nopatologicos);

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
