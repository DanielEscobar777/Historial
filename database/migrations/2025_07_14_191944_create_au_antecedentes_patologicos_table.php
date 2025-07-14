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
        Schema::create('au_antecedentes_patologicos', function (Blueprint $table) {
            $table->increments('id_au_ant_patologicos');
            $table->integer('id_historial')->nullable();
            $table->text('clinicos')->nullable();
            $table->text('quirurjicos')->nullable();
            $table->text('alergicos')->nullable();
            $table->text('otros')->nullable();
            $table->text('internaciones')->nullable();
            $table->text('cirujias')->nullable();
            $table->text('transfusion_de_sangre')->nullable();
            $table->text('iras')->nullable();
            $table->text('gastroenteritis')->nullable();
            $table->text('traumatismos')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('enfermedades')->nullable();
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
        Schema::dropIfExists('au_antecedentes_patologicos');
    }
};
