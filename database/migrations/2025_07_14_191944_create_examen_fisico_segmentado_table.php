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
        Schema::create('examen_fisico_segmentado', function (Blueprint $table) {
            $table->bigIncrements('id_examen_fisico_segmentado');
            $table->bigInteger('id_historial');
            $table->text('cabeza')->nullable();
            $table->text('frontales')->nullable();
            $table->text('cabellos')->nullable();
            $table->text('cara')->nullable();
            $table->text('apertura_ocular')->nullable();
            $table->text('ojos')->nullable();
            $table->text('nariz')->nullable();
            $table->text('fosas_nasales')->nullable();
            $table->text('piramide_nasal')->nullable();
            $table->text('coanas')->nullable();
            $table->text('oidos')->nullable();
            $table->text('pabellon_auricular')->nullable();
            $table->text('curvatura')->nullable();
            $table->text('boca')->nullable();
            $table->text('apertura_bucal')->nullable();
            $table->text('paladar')->nullable();
            $table->text('mucosa_oral')->nullable();
            $table->text('pulmones')->nullable();
            $table->text('pulmones_inspeccion')->nullable();
            $table->text('pulmones_palpacion')->nullable();
            $table->text('pulmones_percusion')->nullable();
            $table->text('pulmones_auscultacion')->nullable();
            $table->text('corazon')->nullable();
            $table->text('corazon_inspeccion')->nullable();
            $table->text('corazon_palpacion')->nullable();
            $table->text('corazon_percusion')->nullable();
            $table->text('corazon_auscultacion')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('abdomen_inspeccion')->nullable();
            $table->text('abdomen_palpacion')->nullable();
            $table->text('abdomen_percusion')->nullable();
            $table->text('abdomen_auscultacion')->nullable();
            $table->text('precordio')->nullable();
            $table->text('cordon_umbilical')->nullable();
            $table->text('relacion_arteriovenosa')->nullable();
            $table->text('genitales_acuerdo_sexo_edad')->nullable();
            $table->text('pies')->nullable();
            $table->text('surcos_plantales')->nullable();
            $table->text('reflejos_succion')->nullable();
            $table->text('genitourinarios')->nullable();
            $table->text('extremidades')->nullable();
            $table->text('neurologicos')->nullable();
            $table->text('craneo')->nullable();
            $table->text('cavidad_bucal')->nullable();
            $table->text('cuello')->nullable();
            $table->text('cuello_inspeccion')->nullable();
            $table->text('cuello_palpacion')->nullable();
            $table->text('cuello_auscultacion')->nullable();
            $table->text('torax')->nullable();
            $table->text('torax_inspeccion_estatico')->nullable();
            $table->text('torax_inspeccion_dinamico')->nullable();
            $table->text('torax_palpacion')->nullable();
            $table->text('torax_percusion')->nullable();
            $table->text('torax_auscultacion')->nullable();
            $table->text('mamas')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_fisico_segmentado');
    }
};
