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
        Schema::create('anamnesis_sistemas', function (Blueprint $table) {
            $table->bigIncrements('id_anamnesis_sistema');
            $table->bigInteger('id_historial');
            $table->string('cardiovascular_respiratorio', 500);
            $table->string('gastro_intestinal', 500);
            $table->string('genito_urinario', 500);
            $table->string('hematologico', 500);
            $table->string('dermatologico', 500);
            $table->string('neurologico', 500);
            $table->string('locomotor', 500);
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesis_sistemas');
    }
};
