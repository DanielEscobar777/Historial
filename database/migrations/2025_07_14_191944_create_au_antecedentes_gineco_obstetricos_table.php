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
        Schema::create('au_antecedentes_gineco_obstetricos', function (Blueprint $table) {
            $table->increments('id_au_ant_familiares');
            $table->integer('id_historial')->nullable();
            $table->text('fecha_ultima_menstruacion')->nullable();
            $table->text('menarca')->nullable();
            $table->text('ritmo_menstrual')->nullable();
            $table->text('menopausia')->nullable();
            $table->text('gestaciones')->nullable();
            $table->text('partos')->nullable();
            $table->text('cesareas')->nullable();
            $table->text('abortos')->nullable();
            $table->text('hijos_macrosomicos')->nullable();
            $table->text('preeclampsia_eclampsia')->nullable();
            $table->text('anticonceptivos')->nullable();
            $table->text('fecha_ultima_papanicolau')->nullable();
            $table->text('fecha_ultima_mamografia')->nullable();
            $table->text('fecha_ultima_densitometria')->nullable();
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
        Schema::dropIfExists('au_antecedentes_gineco_obstetricos');
    }
};
