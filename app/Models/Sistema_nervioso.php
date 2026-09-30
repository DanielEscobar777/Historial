<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sistema_nervioso extends Model
{
    protected $table = 'sistema_nervioso';
    protected $primaryKey = 'id_sistema_nervioso';
    protected $fillable = [
        'id_historial',
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
        'desviacion_o_fasciculacion_de_lengua',
        'id_usuario'
    ];
}
