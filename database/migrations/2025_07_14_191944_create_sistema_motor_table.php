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
        Schema::create('sistema_motor', function (Blueprint $table) {
            $table->bigIncrements('id_sistema_motor');
            $table->bigInteger('id_historial');
            $table->text('tono')->nullable();
            $table->text('trofismo')->nullable();
            $table->text('reflejos_de_estiramiento')->nullable();
            $table->text('balance_muscular_brazo_derecho')->nullable();
            $table->text('balance_muscular_brazo_izquierdo');
            $table->text('balance_muscular_antebrazo_derecho')->nullable();
            $table->text('balance_muscular_antebrazo_izquierdo')->nullable();
            $table->text('balance_muscular_mano_derecho')->nullable();
            $table->text('balance_muscular_mano_izquierdo')->nullable();
            $table->text('balance_muscular_muslo_derecho')->nullable();
            $table->text('balance_muscular_muslo_izquierdo')->nullable();
            $table->text('balance_muscular_pierna_derecho')->nullable();
            $table->text('balance_muscular_pierna_izquierdo')->nullable();
            $table->text('balance_muscular_pie_derecho')->nullable();
            $table->text('balance_muscular_pie_izquierdo')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistema_motor');
    }
};
