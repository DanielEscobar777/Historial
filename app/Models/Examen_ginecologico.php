<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_ginecologico extends Model
{
    protected $table = 'examen_ginecologico';
    protected $primaryKey = 'id_examen_ginecologico';
    protected $fillable = [
        'vello_pubiano',
        'vulva',
        'uretra',
        'glandulas_bys',
        'clitoris',
        'perineo',
        'vagina',
        'cuello_uterino',
        'cuerpo_uterino',
        'anexos',
        'especuloscopia',
        'tacto_rectal',
        'id_usuario'
    ];
}
