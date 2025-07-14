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
        Schema::create('antecedentes_gineco_obstetricos', function (Blueprint $table) {
            $table->bigIncrements('id_antecedentes_gineco');
            $table->bigInteger('id_historial');
            $table->string('fecha_ultima_menstruacion')->nullable();
            $table->string('menarca', 200)->nullable();
            $table->string('ritmo_menstrual', 200)->nullable();
            $table->string('menopausia', 200)->nullable();
            $table->string('gestaciones', 200)->nullable();
            $table->string('partos', 200)->nullable();
            $table->string('cesareas', 200)->nullable();
            $table->string('abortos', 200)->nullable();
            $table->string('hijos_macrosomicos', 200)->nullable();
            $table->string('preeclampsia_eclampsia', 200)->nullable();
            $table->string('anticonceptivos', 200)->nullable();
            $table->string('fecha_ultima_papanicolau')->nullable();
            $table->string('fecha_ultima_mamografia')->nullable();
            $table->string('fecha_ultima_densitometria')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_gineco_obstetricos');
    }
};
