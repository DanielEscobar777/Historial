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
        Schema::create('au_sistema_nervioso', function (Blueprint $table) {
            $table->increments('id_au_sistema_nervioso');
            $table->integer('id_historial')->nullable();
            $table->text('conciencia')->nullable();
            $table->text('gnosia')->nullable();
            $table->text('praxia')->nullable();
            $table->text('lenguaje')->nullable();
            $table->text('memoria')->nullable();
            $table->text('calculo')->nullable();
            $table->text('inteligencia')->nullable();
            $table->text('atencion')->nullable();
            $table->text('emotividad')->nullable();
            $table->text('planificacion')->nullable();
            $table->text('decision')->nullable();
            $table->text('percepcion')->nullable();
            $table->text('paredes_craneales_percepcion')->nullable();
            $table->text('identificacion')->nullable();
            $table->text('agudez_visual')->nullable();
            $table->text('vision_de_colores')->nullable();
            $table->text('campo_visual')->nullable();
            $table->text('pupilas')->nullable();
            $table->text('motilidad_del_globo_ocular')->nullable();
            $table->text('reflejo_fotomotor')->nullable();
            $table->text('reflejos_de_acomodacion')->nullable();
            $table->text('sensitivo')->nullable();
            $table->text('reflejo_corneal')->nullable();
            $table->text('motor')->nullable();
            $table->text('reflejo_maseterino')->nullable();
            $table->text('valora_musculos_expresion_facial')->nullable();
            $table->text('audicion_prueba_rinnne_weber')->nullable();
            $table->text('vestibular')->nullable();
            $table->text('reflejo_nauseoso')->nullable();
            $table->text('tos_debil_o_disfonia')->nullable();
            $table->text('asimetria_paladar_blando_perdida_reflejo_nauseoso')->nullable();
            $table->text('valor_fuerza_esternocleidomastoideo_trapecio')->nullable();
            $table->text('desviacion_o_fasciculacion_de_lengua')->nullable();
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
        Schema::dropIfExists('au_sistema_nervioso');
    }
};
