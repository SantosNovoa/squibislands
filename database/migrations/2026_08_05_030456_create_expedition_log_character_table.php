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
        Schema::create('expedition_log_character', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expedition_log_id');
            $table->unsignedInteger('character_id');
            $table->boolean('success')->nullable(); // null until resolved, then true/false
            $table->timestamps();
            $table->foreign('expedition_log_id')->references('id')->on('expedition_logs')->onDelete('cascade');
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedition_log_character');
    }
};
