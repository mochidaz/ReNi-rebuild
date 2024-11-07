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
        Schema::create('lahan_petani', function (Blueprint $table) {
            $table->integer('id')->lenght(11)->primary();
            $table->char('user_id')->lenght(11);
            $table->foreign('user_id')->references('no_ktp')->on('users');
            $table->integer('luas_lahan')->lenght(11);
            $table->char('lokasi', 255);
            $table->char('name', 255);
            $table->integer('wilayah_id')->lenght(11);
            $table->foreign('wilayah_id')->references('id')->on('wilayah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan_petani');
    }
};
