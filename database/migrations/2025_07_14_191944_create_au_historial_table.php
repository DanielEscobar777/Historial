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
        Schema::create('au_historial', function (Blueprint $table) {
            $table->increments('id_historia');
            $table->string('id_servicio')->nullable();
            $table->string('id_paciente')->nullable();
            $table->text('grado_instruccion')->nullable();
            $table->text('religion')->nullable();
            $table->text('cama')->nullable();
            $table->text('fuente_informacion')->nullable();
            $table->text('nombrenum_referencia')->nullable();
            $table->text('grado_confiabilidad')->nullable();
            $table->text('grupo_sanguineo_facto')->nullable();
            $table->text('nombre_recien_necido')->nullable();
            $table->date('fecha_recien_necido')->nullable();
            $table->text('hora_recien_necido')->nullable();
            $table->text('sexo')->nullable();
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
        Schema::dropIfExists('au_historial');
    }
};
