<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_genito_urinario extends Model
{
    protected $table = 'examen_genito_urinario';
    protected $primaryKey = 'id_examen_genitourinario';
    protected $fillable = [
        'punio_percusion_renal',
        'palpacion_renal',
        'puntos_ureterales',
        'genitales',
        'id_usuario'
    ];
}
