<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentarios';
    protected $fillable = [
        'id_historial',
        'comentarios',
        'id_usuario'
    ];
}
