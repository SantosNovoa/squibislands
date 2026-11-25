<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('event_teams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name')->nullable()->default(null);
            $table->boolean('has_image')->default(0);

            $table->integer('score')->default(0);
        });

        Schema::table('user_settings', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('event_teams');

        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropColumn('team_id');
        });
    }
};
