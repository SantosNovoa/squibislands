<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankThemeColorsTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('rank_theme_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rank_id');
            $table->unsignedInteger('theme_id');
            $table->string('color', 6)->nullable(); // hex without #
            $table->timestamps();

            $table->unique(['rank_id', 'theme_id']);
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('rank_theme_colors');
    }
}
