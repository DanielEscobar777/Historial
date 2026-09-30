<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    /** @use HasFactory<\Database\Factories\EvolucionFactory> */
    use HasFactory;
    protected $primaryKey = 'id_evolucion';
    protected $fillable = [
        'diagnostico',
        'id_evolucion',
        'descripcion',
        's',
        'o',
        'a',
        'p',
        'pa',
        'fc',
        'fr',
        'sat',
        'sat_2',
        'fio2',
        'peso',
        'diuresis',
        'dh'
    ];

    
    public static function traerEvolucion($id_historial)
    {
        return self::where('evolucions.id_historial', $id_historial)
            ->get();
    }
}
