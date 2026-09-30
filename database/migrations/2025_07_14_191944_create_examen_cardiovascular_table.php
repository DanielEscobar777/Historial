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
        Schema::create('examen_cardiovascular', function (Blueprint $table) {
            $table->bigIncrements('id_examen_cardiovascular');
            $table->bigInteger('id_historial');
            $table->text('cardiovascular_palpacion')->nullable();
            $table->text('cardiovascular_percusion')->nullable();
            $table->text('cardiovascular_auscultacion')->nullable();
            $table->text('cardiovascular_agregados')->nullable();
            $table->text('cardiovascular_soplos')->nullable();
            $table->text('cardiovascular_fremito')->nullable();
            $table->text('pulsos_perifericos')->nullable();
            $table->text('branquial')->nullable();
            $table->text('femoral')->nullable();
            $table->text('tibia')->nullable();
            $table->text('radial')->nullable();
            $table->text('popliteo')->nullable();
            $table->text('pedio')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_cardiovascular');
    }
};
