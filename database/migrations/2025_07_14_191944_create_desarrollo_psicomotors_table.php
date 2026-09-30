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
        Schema::create('desarrollo_psicomotors', function (Blueprint $table) {
            $table->bigIncrements('id_desarrollo_psicomotor');
            $table->bigInteger('id_historial');
            $table->text('desarrollo_psicomotor');
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desarrollo_psicomotors');
    }
};
