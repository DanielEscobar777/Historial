<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_fisico_segmentado extends Model
{
    protected $table = 'examen_fisico_segmentado';
    protected $primaryKey = 'id_examen_fisico_segmentado';
    protected $fillable = [
        'cabeza',
        'frontales',
        'cabellos',
        'cara',
        'apertura_ocular',
        'ojos',
        'nariz',
        'fosas_nasales',
        'piramide_nasal',
        'coanas',
        'oidos',
        'pabellon_auricular',
        'curvatura',
        'boca',
        'apertura_bucal',
        'paladar',
        'mucosa_oral',
        'pulmones',
        'pulmones_inspeccion',
        'pulmones_palpacion',
        'pulmones_percusion',
        'pulmones_auscultacion',
        'corazon',
        'corazon_inspeccion',
        'corazon_palpacion',
        'corazon_percusion',
        'corazon_auscultacion',
        'abdomen',
        'abdomen_inspeccion',
        'abdomen_palpacion',
        'abdomen_percusion',
        'abdomen_auscultacion',
        'precordio',
        'cordon_umbilical',
        'relacion_arteriovenosa',
        'genitales_acuerdo_sexo_edad',
        'pies',
        'surcos_plantales',
        'reflejos_succion',
        'genitourinarios',
        'extremidades',
        'neurologicos',
        'craneo',
        'cavidad_bucal',
        'cuello',
        'cuello_inspeccion',
        'cuello_palpacion',
        'cuello_auscultacion',
        'torax',
        'torax_inspeccion_estatico',
        'torax_inspeccion_dinamico',
        'torax_palpacion',
        'torax_percusion',
        'torax_auscultacion',
        'mamas',
        'id_usuario'
    ];
}
