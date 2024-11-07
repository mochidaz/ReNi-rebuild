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
        Schema::create('artikel_image', function (Blueprint $table) {
            $table->integer('id')->lenght(11)->primary();
            $table->integer('artikel_id')->length(11);
            $table->foreign('artikel_id')->references('id')->on('artikel');
            $table->char('image', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_image');
    }
};
