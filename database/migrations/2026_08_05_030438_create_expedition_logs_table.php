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
        Schema::create('expedition_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expedition_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('started_at');
            $table->dateTime('completes_at');
            $table->boolean('is_processed')->default(0);
            $table->boolean('is_claimed')->default(0);
            $table->timestamps();
            $table->foreign('expedition_id')->references('id')->on('expeditions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedition_logs');
    }
};
