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
        Schema::create('antecedentes_alimentarios', function (Blueprint $table) {
            $table->bigIncrements('id_antecedentes_alimentarios');
            $table->bigInteger('id_historial');
            $table->text('antecedentes_alimentarios');
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_alimentarios');
    }
};
