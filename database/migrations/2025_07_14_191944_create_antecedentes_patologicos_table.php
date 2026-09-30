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
        Schema::create('antecedentes_patologicos', function (Blueprint $table) {
            $table->bigIncrements('id_antecedentes_patologicos');
            $table->bigInteger('id_historial');
            $table->string('clinicos', 200)->nullable();
            $table->string('quirurjicos', 200)->nullable();
            $table->string('alergicos', 200)->nullable();
            $table->string('otros', 200)->nullable();
            $table->string('internaciones', 200)->nullable();
            $table->string('cirujias', 200)->nullable();
            $table->string('transfusion_de_sangre', 200)->nullable();
            $table->string('iras', 200)->nullable();
            $table->string('gastroenteritis', 200)->nullable();
            $table->string('traumatismos', 200)->nullable();
            $table->string('medicamentos', 200)->nullable();
            $table->string('enfermedades', 200)->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_patologicos');
    }
};
