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
        Schema::create('ocupacion_graduados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('graduado_id');
            $table->enum('ocupacion_trabajo', ['rel_dependencia', 'autonomo'])->nullable();
            $table->string('ocupacion_empresa')->nullable();
            $table->enum('ocupacion_sector', ['privado', 'publico'])->nullable();
            $table->text('ocupacion_informacion_adicional')->nullable();
            
            $table->foreign('graduado_id')->references('id')->on('graduados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocupacion_graduados');
    }
};
