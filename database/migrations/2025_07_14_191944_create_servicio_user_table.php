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
        Schema::create('servicio_user', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->bigInteger('servicio_id')->index('idx_servicio_id');
            $table->char('trial526', 1)->nullable();

            $table->primary(['user_id', 'servicio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_user');
    }
};
