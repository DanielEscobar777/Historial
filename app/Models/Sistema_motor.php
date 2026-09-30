<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sistema_motor extends Model
{
    protected $table = 'sistema_motor';
    protected $primaryKey = 'id_sistema_motor';
    protected $fillable = [
        'id_historial',
        'tono',
        'trofismo',
        'reflejos_de_estiramiento',
        'balance_muscular_brazo_derecho',
        'balance_muscular_brazo_izquierdo',
        'balance_muscular_antebrazo_derecho',
        'balance_muscular_antebrazo_izquierdo',
        'balance_muscular_mano_derecho',
        'balance_muscular_mano_izquierdo',
        'balance_muscular_muslo_derecho',
        'balance_muscular_muslo_izquierdo',
        'balance_muscular_pierna_derecho',
        'balance_muscular_pierna_izquierdo',
        'balance_muscular_pie_derecho',
        'balance_muscular_pie_izquierdo',
        'id_usuario'
    ];
}
