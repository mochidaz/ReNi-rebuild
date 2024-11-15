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
        Schema::create('user_data', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('user_id', 255);
            $table->foreign('user_id')->references('no_ktp')->on('users');
            $table->char('address', 255);
            $table->char('phone_number', 255);
            $table->char('profile_photo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
