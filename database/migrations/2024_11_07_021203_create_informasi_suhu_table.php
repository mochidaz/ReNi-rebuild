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
        Schema::create('informasi_suhu', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->text('content');
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
        Schema::dropIfExists('informasi_suhu');
    }
};
