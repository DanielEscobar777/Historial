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
        Schema::create('au_antecedentes_no_patologicos', function (Blueprint $table) {
            $table->increments('id_au_ant_inmunizacion');
            $table->integer('id_historial')->nullable();
            $table->text('vacunas')->nullable();
            $table->text('vacunas_hpv')->nullable();
            $table->text('habitos_toxicos')->nullable();
            $table->text('alimentacion')->nullable();
            $table->text('habito_miccional')->nullable();
            $table->text('habito_intestinal')->nullable();
            $table->text('vivienda_servicio_basico')->nullable();
            $table->text('habito_alcoholico')->nullable();
            $table->text('habito_tabaquico')->nullable();
            $table->text('exposicion_biomasa')->nullable();
            $table->text('contacto_con_tuberculosis')->nullable();
            $table->text('contacto_triatoma_infestans')->nullable();
            $table->text('toxicomanias_drogas')->nullable();
            $table->text('inmunizaciones')->nullable();
            $table->text('antecedentes_sexuales')->nullable();
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
        Schema::dropIfExists('au_antecedentes_no_patologicos');
    }
};
