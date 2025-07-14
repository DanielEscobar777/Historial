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
        Schema::create('au_examen_ginecologico', function (Blueprint $table) {
            $table->increments('id_au_exm_ginecologico');
            $table->integer('id_historial')->nullable();
            $table->text('vello_pubiano')->nullable();
            $table->text('vulva')->nullable();
            $table->text('uretra')->nullable();
            $table->text('clitoris')->nullable();
            $table->text('perineo')->nullable();
            $table->text('vagina')->nullable();
            $table->text('cuello_uterino')->nullable();
            $table->text('cuerpo_uterino')->nullable();
            $table->text('anexos')->nullable();
            $table->text('especuloscopia')->nullable();
            $table->text('tacto_rectal')->nullable();
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
        Schema::dropIfExists('au_examen_ginecologico');
    }
};
