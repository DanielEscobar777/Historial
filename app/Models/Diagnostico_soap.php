<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico_soap extends Model
{
    /** @use HasFactory<\Database\Factories\DiagnosticoSoapFactory> */
    use HasFactory;
     protected $primaryKey = 'id_diagnostico_soaps';
        protected $fillable = [
        'diagnostico'
    ];

      public static function traerDiagnostico($id_historia)
    {
        return self::where('diagnostico_soaps.id_historial', $id_historia)
            ->get();
    }
}
