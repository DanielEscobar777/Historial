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
        Schema::create('dermatologia', function (Blueprint $table) {
            $table->bigIncrements('id_dermatologia');
            $table->bigInteger('id_historial');
            $table->text('piel');
            $table->text('pelo')->nullable();
            $table->text('unias')->nullable();
            $table->text('mucosas')->nullable();
            $table->text('topografia')->nullable();
            $table->text('iconografia')->nullable();
            $table->text('morfologia')->nullable();
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dermatologia');
    }
};
