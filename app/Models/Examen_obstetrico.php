<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen_obstetrico extends Model
{
    protected $table = 'examen_obstetrico';
    protected $primaryKey = 'id_examen_obstetrico';
     protected $fillable = [
      'genitales',
      'flujos',
      'afu',
      'situacion',
      'posicion',
      'tacto_vaginal',
      'fcf',
      'presentacion',
      'movimientos_fetales',
      'id_usuario'
    ];
    
}
