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
        Schema::create('examen_fisico_generals', function (Blueprint $table) {
            $table->bigIncrements('id_examen_general');
            $table->bigInteger('id_historial');
            $table->string('estado_de_conciencia', 200);
            $table->string('color_piel_mucosa', 200);
            $table->string('constitucion', 200);
            $table->string('marcha', 200)->nullable();
            $table->string('posicion', 200)->nullable();
            $table->string('estado_hidratacion', 200)->nullable();
            $table->string('biotipo', 200)->nullable();
            $table->string('facies', 200)->nullable();
            $table->string('tension_arterial', 200)->nullable();
            $table->string('tension_arterial_media', 200)->nullable();
            $table->string('frecuencia_cardiaca', 200)->nullable();
            $table->string('frecuencia_respiratoria', 200)->nullable();
            $table->string('temperatura', 200)->nullable();
            $table->string('peso', 200)->nullable();
            $table->string('talla', 200)->nullable();
            $table->string('imc', 200)->nullable();
            $table->string('spo2', 200)->nullable();
            $table->string('sato2', 200)->nullable();
            $table->string('fio2', 200)->nullable();
            $table->string('sc', 200)->nullable();
            $table->string('apgar', 200)->nullable();
            $table->string('silverman', 200)->nullable();
            $table->string('edad_por_capurro', 200)->nullable();
            $table->string('pa', 200)->nullable();
            $table->string('somatometria', 200)->nullable();
            $table->string('saturacion', 200)->nullable();
            $table->string('perimetro_cefalico', 200)->nullable();
            $table->string('perimetro_toracico', 200)->nullable();
            $table->string('perimetro_abdominal', 200)->nullable();
            $table->string('examen_fisico_general', 500)->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_fisico_generals');
    }
};
