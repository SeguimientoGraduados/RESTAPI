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
        Schema::create('formacion_graduados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('graduado_id');
            $table->string('institucion');
            $table->string('titulo');
            $table->enum('nivel',['secundario', 'terciario', 'universitario', 'otro']);
            
            $table->foreign('graduado_id')->references('id')->on('graduados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacion_graduados');
    }
};
