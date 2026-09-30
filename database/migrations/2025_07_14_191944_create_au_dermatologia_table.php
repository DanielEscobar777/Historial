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
        Schema::create('au_dermatologia', function (Blueprint $table) {
            $table->increments('id_au_desarrollo');
            $table->integer('id_historial')->nullable();
            $table->text('piel')->nullable();
            $table->text('pelo')->nullable();
            $table->text('unias')->nullable();
            $table->text('mucosas')->nullable();
            $table->text('topografia')->nullable();
            $table->text('iconografia')->nullable();
            $table->text('morfologia')->nullable();
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
        Schema::dropIfExists('au_dermatologia');
    }
};
