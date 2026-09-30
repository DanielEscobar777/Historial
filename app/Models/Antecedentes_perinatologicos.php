<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_perinatologicos extends Model
{
     protected $fillable = [
        'id_historial',
        'antecedentes_perinatologicos',
        'id_usuario'
    ];
    protected $primaryKey = 'id_antecedentes_perinatologicos';


}
