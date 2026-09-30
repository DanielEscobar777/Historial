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
        Schema::create('interpretacion_laboratorios_de_estudio_y_gabinetes', function (Blueprint $table) {
            $table->bigIncrements('id_interpretacion');
            $table->bigInteger('id_historial');
            $table->text('laboratorios_de_estudio_y_gabinete_solicitados');
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interpretacion_laboratorios_de_estudio_y_gabinetes');
    }
};
