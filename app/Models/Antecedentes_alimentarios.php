<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_alimentarios extends Model
{
      protected $fillable = [
        'id_historial',
        'antecedentes_alimentarios',
        'id_usuario'
    ];

    protected $primaryKey = 'id_antecedentes_alimentarios';
}
