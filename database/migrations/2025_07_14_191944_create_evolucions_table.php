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
        Schema::create('evolucions', function (Blueprint $table) {
            $table->increments('id_evolucion');
            $table->text('descripcion');
            $table->text('s');
            $table->text('o');
            $table->text('a');
            $table->text('p');
            $table->string('pa', 10);
            $table->integer('fc');
            $table->integer('fr');
            $table->decimal('sat', 10);
            $table->decimal('sat_2', 10);
            $table->decimal('fio2', 10);
            $table->decimal('peso', 10);
            $table->decimal('diuresis', 10);
            $table->decimal('dh', 10);
            $table->date('fecha_registro');
            $table->time('hora_registro');
            $table->integer('id_usuario');
            $table->integer('id_historial')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucions');
    }
};
