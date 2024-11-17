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
            $table->string('ip', 50);
            $table->string('port', 10); 
            $table->string('user')->default('admin');
            $table->string('password')->default('admin');
            $table->string('nombre');
            $table->integer('estado')->default(0); // 0 = Desconectada, 1 = Conectada
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
