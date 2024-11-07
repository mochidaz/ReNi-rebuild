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
        Schema::create('users', function (Blueprint $table) {
            $table->char('no_ktp', 255)->primary();
            $table->char('name', 255);
            $table->char('password', 255);
            $table->integer('role_id')->length(11);
            $table->foreign('role_id')->references('id')->on('role');
            $table->char('token' ,255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
