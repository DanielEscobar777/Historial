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
        Schema::create('au_sistema_sensitivo', function (Blueprint $table) {
            $table->increments('id_au_sistema_sensitivo');
            $table->integer('id_historial')->nullable();
            $table->text('sensibilidad_superficial')->nullable();
            $table->text('sensibilidad_profunda_consciente')->nullable();
            $table->text('sensibilidad_profunda_inconsciente')->nullable();
            $table->text('sistema_vestibulo_cerebeloso')->nullable();
            $table->text('signos_irritacion_meningea')->nullable();
            $table->text('marcha')->nullable();
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
        Schema::dropIfExists('au_sistema_sensitivo');
    }
};
