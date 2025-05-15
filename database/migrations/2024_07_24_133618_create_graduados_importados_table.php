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
        Schema::create('graduados_importados', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombre_final');
            $table->date('fecha_egreso');
            $table->string('carrera');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduados_importados');
    }
};
