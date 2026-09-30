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
        Schema::table('examenes_complementarios', function (Blueprint $table) {
            $table->foreign(['id_historial'], 'examenes_complementario_id_historial_foreign')->references(['id_historia'])->on('historials')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examenes_complementarios', function (Blueprint $table) {
            $table->dropForeign('examenes_complementario_id_historial_foreign');
        });
    }
};
