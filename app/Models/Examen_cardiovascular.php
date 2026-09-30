<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_cardiovascular extends Model
{
    protected $table = 'examen_cardiovascular';
    protected $primaryKey = 'id_examen_cardiovascular';
    protected $fillable = [
        'cardiovascular_palpacion',
        'cardiovascular_percusion',
        'cardiovascular_auscultacion',
        'cardiovascular_agregados',
        'cardiovascular_soplos',
        'cardiovascular_fremito',
        'pulsos_perifericos',
        'branquial',
        'femoral',
        'tibia',
        'radial',
        'popliteo',
        'pedio',
        'id_usuario'
    ];
}
