<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anamnesis_sistemas extends Model
{
    protected $primaryKey = 'id_anamnesis_sistema';
    protected $fillable = [
        'cardiovascular_respiratorio',
        'gastro_intestinal',
        'genito_urinario',
        'hematologico',
        'dermatologico',
        'neurologico',
        'locomotor',
        'id_usuario'
    ];
}
