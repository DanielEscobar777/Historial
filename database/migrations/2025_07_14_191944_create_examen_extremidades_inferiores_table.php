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
        Schema::create('examen_extremidades_inferiores', function (Blueprint $table) {
            $table->bigIncrements('id_examen_extremidades_inferiores');
            $table->bigInteger('id_historial');
            $table->text('i_simetria')->nullable();
            $table->text('i_deformidades')->nullable();
            $table->text('i_articulaciones')->nullable();
            $table->text('i_piel')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_extremidades_inferiores');
    }
};
