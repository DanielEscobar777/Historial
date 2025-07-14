<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('au_examen_fisico_generals', function (Blueprint $table) {
            $table->increments('id_au_exm_general');
            $table->integer('id_historial')->nullable();
            $table->text('estado_de_conciencia')->nullable();
            $table->text('color_piel_mucosa')->nullable();
            $table->text('constitucion')->nullable();
            $table->text('marcha')->nullable();
            $table->text('posicion')->nullable();
            $table->text('estado_hidratacion')->nullable();
            $table->text('biotipo')->nullable();
            $table->text('facies')->nullable();
            $table->text('tension_arterial')->nullable();
            $table->text('tension_arterial_media')->nullable();
            $table->text('frecuencia_cardiaca')->nullable();
            $table->text('frecuencia_respiratoria')->nullable();
            $table->text('temperatura')->nullable();
            $table->text('peso')->nullable();
            $table->text('talla')->nullable();
            $table->text('imc')->nullable();
            $table->text('spo2')->nullable();
            $table->text('sato2')->nullable();
            $table->text('fio2')->nullable();
            $table->text('sc')->nullable();
            $table->text('apgar')->nullable();
            $table->text('silverman')->nullable();
            $table->text('edad_por_capurro')->nullable();
            $table->text('pa')->nullable();
            $table->text('somatometria')->nullable();
            $table->text('saturacion')->nullable();
            $table->text('perimetro_cefalico')->nullable();
            $table->text('perimetro_toracico')->nullable();
            $table->text('perimetro_abdominal')->nullable();
            $table->text('examen_fisico_general')->nullable();
            $table->integer('id_usuario')->nullable();
            $table->string('operacion', 60)->nullable();
            $table->timestamp('fecha_modificacion')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('au_examen_fisico_generals');
    }
};
