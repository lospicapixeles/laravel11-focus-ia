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
        Schema::create('camaras', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('port');
            $table->string('user');
            $table->string('password');
            $table->integer('status')->default(1); // 1: activo, 0: inactivo, 2: en mantenimiento
            $table->string('info');
            $table->unsignedBigInteger('aulas_id');
            $table->foreign('aulas_id')->references('id')->on('aulas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camaras');
    }
};
