<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_extremidades_superiores extends Model
{
    protected $table = 'examen_extremidades_superiores';
    protected $primaryKey = 'id_examen_extremidades_superiores';
    protected $fillable = [
        's_simetria',
        's_deformidades',
        's_articulaciones',
        's_piel',
        'id_usuario'
    ];
}
