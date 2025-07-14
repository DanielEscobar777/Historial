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
        Schema::create('au_anamnesis_sistemas', function (Blueprint $table) {
            $table->increments('id_au_anamnesis');
            $table->integer('id_historial')->nullable();
            $table->text('cardiovascular_respiratorio')->nullable();
            $table->text('gastro_intestinal')->nullable();
            $table->text('genito_urinario')->nullable();
            $table->text('hematologico')->nullable();
            $table->text('dermatologico')->nullable();
            $table->text('neurologico')->nullable();
            $table->text('locomotor')->nullable();
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
        Schema::dropIfExists('au_anamnesis_sistemas');
    }
};
