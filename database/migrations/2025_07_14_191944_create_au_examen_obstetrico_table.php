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
        Schema::create('au_examen_obstetrico', function (Blueprint $table) {
            $table->increments('id_au_exm_obstetrico');
            $table->integer('id_historial')->nullable();
            $table->text('genitales')->nullable();
            $table->text('flujos')->nullable();
            $table->text('afu')->nullable();
            $table->text('situacion')->nullable();
            $table->text('posicion')->nullable();
            $table->text('tacto_vaginal')->nullable();
            $table->text('fcf')->nullable();
            $table->text('presentacion')->nullable();
            $table->text('movimientos_fetales')->nullable();
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
        Schema::dropIfExists('au_examen_obstetrico');
    }
};
