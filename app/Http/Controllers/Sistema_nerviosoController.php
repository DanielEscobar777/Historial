<?php

namespace App\Http\Controllers;

use App\Models\Sistema_nervioso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sistema_nerviosoController extends Controller
{
    public function update(Request $request, $id_sistema_nervioso)
    {
        $userId = Auth::id();
        $rules = [];
        $messages = [];
        // Solo validar los campos que vienen en el request
        foreach (
            [
                'conciencia',
                'gnosia',
                'praxia',
                'lenguaje',
                'memoria',
                'calculo',
                'inteligencia',
                'atencion',
                'emotividad',
                'planificacion',
                'decision',
                'percepcion',
                'paredes_craneales_percepcion',
                'identificacion',
                'agudez_visual',
                'vision_de_colores',
                'campo_visual',
                'pupilas',
                'motilidad_del_globo_ocular',
                'reflejo_fotomotor',
                'reflejos_de_acomodacion',
                'sensitivo',
                'reflejo_corneal',
                'motor',
                'reflejo_maseterino',
                'valora_musculos_expresion_facial',
                'audicion_prueba_rinnne_weber',
                'vestibular',
                'reflejo_nauseoso',
                'tos_debil_o_disfonia',
                'asimetria_paladar_blando_perdida_reflejo_nauseoso',
                'valor_fuerza_esternocleidomastoideo_trapecio',
                'desviacion_o_fasciculacion_de_lengua'
            ] as $field
        ) {
            if ($request->has($field)) {
                $rules[$field] = 'required|string';
                $messages["$field.required"] = "El campo $field es obligatorio.";
            }
        }
        $validated = $request->validate($rules, $messages);
        $antecedentes = Sistema_nervioso::findOrFail($id_sistema_nervioso);

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
