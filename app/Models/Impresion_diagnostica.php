<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impresion_diagnostica extends Model
{
    protected $table = 'impresion_diagnostica';
    protected $primaryKey = 'id_impresion_diagnostica';
    protected $fillable = [
        'impresion_diagnostica',
        'id_usuario'
    ];
}
