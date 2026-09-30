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
        Schema::create('au_examen_cardiovascular', function (Blueprint $table) {
            $table->increments('id_au_exm_cardiovascular');
            $table->integer('id_historial')->nullable();
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
        Schema::dropIfExists('au_examen_cardiovascular');
    }
};
