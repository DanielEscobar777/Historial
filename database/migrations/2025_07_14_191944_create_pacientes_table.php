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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres', 100);
            $table->string('p_apellido', 100);
            $table->string('s_apellido', 100)->nullable();
            $table->string('matricula_seguro', 50)->nullable();
            $table->char('sexo', 1)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('ci', 20)->nullable()->unique('pacientes_ci_key');
            $table->string('complemento', 10)->nullable();
            $table->string('nacionalidad', 50)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->text('residencia')->nullable();
            $table->timestamp('creado_en')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
