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
        Schema::create('au_diagnostico_soaps', function (Blueprint $table) {
            $table->increments('id_au_diagnostico_soaps');
            $table->integer('id_evolucion')->nullable();
            $table->integer('id_historial')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('navegador')->nullable();
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
        Schema::dropIfExists('au_diagnostico_soaps');
    }
};
