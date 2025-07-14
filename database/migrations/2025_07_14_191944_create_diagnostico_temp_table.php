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
        Schema::create('diagnostico_temp', function (Blueprint $table) {
            $table->increments('id_temporal');
            $table->string('diagnostico');
            $table->integer('id_historial')->nullable();
            $table->integer('id_usuario');
            $table->text('navegador')->nullable();
            $table->char('trial516', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico_temp');
    }
};
