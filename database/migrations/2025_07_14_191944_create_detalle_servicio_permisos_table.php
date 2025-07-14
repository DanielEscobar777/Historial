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
        Schema::create('detalle_servicio_permisos', function (Blueprint $table) {
            $table->increments('id_detalle_servicio_permiso');
            $table->integer('id_servicio');
            $table->integer('id_permisos_historia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_servicio_permisos');
    }
};
