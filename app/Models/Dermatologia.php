<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dermatologia extends Model
{
    protected $table = 'dermatologia';
    protected $primaryKey = 'id_dermatologia';
    protected $fillable = [
        'piel',
        'pelo',
        'unias',
        'mucosas',
        'topografia',
        'iconografia',
        'morfologia',
        'id_usuario'
    ];
}
