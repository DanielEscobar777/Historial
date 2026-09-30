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
        Schema::create('examen_extremidades_superiores', function (Blueprint $table) {
            $table->bigIncrements('id_examen_extremidades_superiores');
            $table->bigInteger('id_historial');
            $table->text('s_simetria')->nullable();
            $table->text('s_deformidades')->nullable();
            $table->text('s_articulaciones')->nullable();
            $table->text('s_piel')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_extremidades_superiores');
    }
};
