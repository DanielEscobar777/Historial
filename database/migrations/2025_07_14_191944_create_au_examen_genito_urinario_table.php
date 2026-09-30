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
        Schema::create('au_examen_genito_urinario', function (Blueprint $table) {
            $table->increments('id_au_exm_genitourinario');
            $table->integer('id_historial')->nullable();
            $table->text('punio_percusion_renal')->nullable();
            $table->text('palpacion_renal')->nullable();
            $table->text('puntos_ureterales')->nullable();
            $table->text('genitales')->nullable();
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
        Schema::dropIfExists('au_examen_genito_urinario');
    }
};
