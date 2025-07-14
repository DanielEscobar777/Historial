<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_familiares extends Model
{
     protected $fillable = [
        'id_historial',
        'antecedentes_familiares',
        'id_usuario'
    ];
   protected $primaryKey = 'id_antecedentes_familiares';
}
