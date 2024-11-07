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
        Schema::create('data_panen', function (Blueprint $table) {
            $table->integer('id')->lenght(11)->primary();
            $table->date('tanggal_penanaman');
            $table->date('tanggal_panen');
            $table->integer('pangan_id')->lenght(11);
            $table->foreign('pangan_id')->references('id')->on('pangan');
            $table->char('user_id', 255);
            $table->foreign('user_id')->references('no_ktp')->on('users');
            $table->integer('hasil_panen')->lenght(11);
            $table->integer('lahan_id')->lenght(11);
            $table->foreign('lahan_id')->references('id')->on('lahan_petani');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_panen');
    }
};
