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
        Schema::table('antecedentes_patologicos', function (Blueprint $table) {
            $table->foreign(['id_historial'])->references(['id_historia'])->on('historials')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedentes_patologicos', function (Blueprint $table) {
            $table->dropForeign('antecedentes_patologicos_id_historial_foreign');
        });
    }
};
