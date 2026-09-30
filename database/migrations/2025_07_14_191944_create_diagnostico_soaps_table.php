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
        Schema::create('diagnostico_soaps', function (Blueprint $table) {
            $table->increments('id_diagnostico_soaps');
            $table->integer('id_evolucion');
            $table->integer('id_historial')->nullable();
            $table->text('diagnostico');
            $table->text('navegador')->nullable();
            $table->integer('id_usuario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico_soaps');
    }
};
