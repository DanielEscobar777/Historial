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
        Schema::create('au_evolucions', function (Blueprint $table) {
            $table->increments('id_au_evolucions');
            $table->text('descripcion')->nullable();
            $table->text('s')->nullable();
            $table->text('o')->nullable();
            $table->text('a')->nullable();
            $table->text('p')->nullable();
            $table->text('pa')->nullable();
            $table->integer('fc')->nullable();
            $table->integer('fr')->nullable();
            $table->decimal('sat', 10)->nullable();
            $table->decimal('sat_2', 10)->nullable();
            $table->decimal('fio2', 10)->nullable();
            $table->decimal('peso', 10)->nullable();
            $table->decimal('diuresis', 10)->nullable();
            $table->decimal('dh', 10)->nullable();
            $table->integer('id_historial')->nullable();
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
        Schema::dropIfExists('au_evolucions');
    }
};
