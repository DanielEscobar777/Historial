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
        Schema::create('au_examen_extremidades_inferiores', function (Blueprint $table) {
            $table->increments('id_au_exm_extremisades_i');
            $table->integer('id_historial')->nullable();
            $table->text('i_simetria')->nullable();
            $table->text('i_deformidades')->nullable();
            $table->text('i_articulaciones')->nullable();
            $table->text('i_piel')->nullable();
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
        Schema::dropIfExists('au_examen_extremidades_inferiores');
    }
};
