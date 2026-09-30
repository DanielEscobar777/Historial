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
        Schema::create('au_sistema_motor', function (Blueprint $table) {
            $table->increments('id_au_impresion_diagnostica');
            $table->integer('id_historial')->nullable();
            $table->text('tono')->nullable();
            $table->text('trofismo')->nullable();
            $table->text('reflejos_de_estiramiento')->nullable();
            $table->text('balance_muscular_brazo_derecho')->nullable();
            $table->text('balance_muscular_brazo_izquierdo')->nullable();
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
        Schema::dropIfExists('au_sistema_motor');
    }
};
