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
        Schema::create('antecedentes_no_patologicos', function (Blueprint $table) {
            $table->bigIncrements('id_antecedentes_nopatologicos');
            $table->bigInteger('id_historial');
            $table->string('vacunas', 200)->nullable();
            $table->string('vacunas_hpv', 200)->nullable();
            $table->string('habitos_toxicos', 200)->nullable();
            $table->string('alimentacion', 200)->nullable();
            $table->string('habito_miccional', 200)->nullable();
            $table->string('habito_intestinal', 200)->nullable();
            $table->string('vivienda_servicio_basico', 200)->nullable();
            $table->string('habito_alcoholico', 200)->nullable();
            $table->string('habito_tabaquico', 200)->nullable();
            $table->string('exposicion_biomasa', 200)->nullable();
            $table->string('contacto_con_tuberculosis', 200)->nullable();
            $table->string('contacto_triatoma_infestans', 200)->nullable();
            $table->string('toxicomanias_drogas', 200)->nullable();
            $table->string('inmunizaciones', 200)->nullable();
            $table->string('antecedentes_sexuales', 200)->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_no_patologicos');
    }
};
