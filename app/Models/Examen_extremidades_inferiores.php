<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_extremidades_inferiores extends Model
{
    protected $table = 'examen_extremidades_inferiores';
    protected $primaryKey = 'id_examen_extremidades_inferiores';
    protected $fillable = [
        'i_simetria',
        'i_deformidades',
        'i_articulaciones',
        'i_piel',
        'id_usuario'
    ];
}
