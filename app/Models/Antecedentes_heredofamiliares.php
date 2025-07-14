<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedentes_heredofamiliares extends Model
{
    protected $fillable = [
        'id_historial',
        'padre',
        'madre',
        'hermano',
        'esposo',
        'hijos',
        'id_usuario'
    ];
    protected $primaryKey = 'id_antecedentes_heredofamiliares';
}
