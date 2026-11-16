<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('bosses', function (Blueprint $table) {
            // send earned rewards to participants automatically when the boss is defeated
            $table->boolean('auto_distribute_rewards')->default(false)->after('allow_users_to_claim_rewards');
            // optional graphic used for the featured daily attack button
            $table->string('daily_button_image')->nullable()->default(null)->after('auto_distribute_rewards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('bosses', function (Blueprint $table) {
            $table->dropColumn(['auto_distribute_rewards', 'daily_button_image']);
        });
    }
};
