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
        Schema::create('emocions', function (Blueprint $table) {
            $table->id();
            $table->json('expresiones');
            $table->json('parametros')->nullable();
            $table->unsignedBigInteger('sesions_id');
            $table->foreign('sesions_id')->references('id')->on('sesions');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emocions');
    }
};
