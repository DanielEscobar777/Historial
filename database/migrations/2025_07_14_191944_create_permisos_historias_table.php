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
        Schema::create('permisos_historias', function (Blueprint $table) {
            $table->increments('id_permisos_historia');
            $table->string('nombre_permiso', 50);
            $table->integer('nivel');
            $table->string('modulo', 5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_historias');
    }
};
