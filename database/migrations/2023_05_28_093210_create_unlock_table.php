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
        Schema::create('unlock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customization_id');
            $table->unsignedBigInteger('user_id');
            $table->Integer('unlock_status');
            $table->timestamps();

            $table->foreign('customization_id')->references('id')->on('customization');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unlock');
    }
};
