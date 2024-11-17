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
        Schema::create('sesions', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->unsignedBigInteger('aulas_id');
            $table->foreign('aulas_id')->references('id')->on('aulas');
            $table->unsignedBigInteger('cursos_id');
            $table->foreign('cursos_id')->references('id')->on('cursos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesions');
    }
};
