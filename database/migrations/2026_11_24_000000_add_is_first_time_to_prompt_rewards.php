<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('prompt_rewards', function (Blueprint $table) {
            // bonus rewards granted only the first time a user has a submission to the prompt approved
            $table->boolean('is_first_time')->default(false)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('prompt_rewards', function (Blueprint $table) {
            $table->dropColumn('is_first_time');
        });
    }
};
