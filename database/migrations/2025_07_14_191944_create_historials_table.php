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
        Schema::create('historials', function (Blueprint $table) {
            $table->bigIncrements('id_historia');
            $table->bigInteger('id_servicio');
            $table->integer('id_paciente')->nullable();
            $table->string('grado_instruccion', 100)->nullable();
            $table->string('religion', 50)->nullable();
            $table->date('fecha_registro');
            $table->time('hora_registro');
            $table->string('cama', 50);
            $table->string('fuente_informacion', 200)->nullable();
            $table->string('nombrenum_referencia', 200);
            $table->string('grado_confiabilidad', 100)->nullable();
            $table->string('grupo_sanguineo_facto', 50)->nullable();
            $table->string('nombre_recien_necido', 50)->nullable();
            $table->date('fecha_recien_necido')->nullable();
            $table->time('hora_recien_necido')->nullable();
            $table->string('sexo', 50)->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
            $table->string('ocupacion', 100)->nullable();
            $table->string('estado_civil', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historials');
    }
};
