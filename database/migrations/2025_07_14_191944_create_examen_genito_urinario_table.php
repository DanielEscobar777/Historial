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
        Schema::create('examen_genito_urinario', function (Blueprint $table) {
            $table->bigIncrements('id_examen_genitourinario');
            $table->bigInteger('id_historial');
            $table->text('punio_percusion_renal')->nullable();
            $table->text('palpacion_renal')->nullable();
            $table->text('puntos_ureterales')->nullable();
            $table->text('genitales')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_genito_urinario');
    }
};
