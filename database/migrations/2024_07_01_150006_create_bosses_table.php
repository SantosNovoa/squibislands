<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('bosses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('hash')->nullable()->default(null); // random string for image path (if has_image is true
            $table->boolean('has_image')->default(false);

            $table->boolean('is_active')->default(true);
            $table->timestamp('start_at')->nullable()->default(null);
            $table->timestamp('end_at')->nullable()->default(null);

            $table->integer('total_health');
            $table->integer('current_health');
            $table->json('attack_methods')->nullable()->default(null);
            $table->json('stage_images')->nullable()->default(null);

            $table->enum('type', ['Global', 'User'])->default('Global');

            $table->boolean('can_attack_after_defeat')->default(false); // if set to true the boss can be attacked until the end_at date
            $table->boolean('is_rewards_only_for_participants')->default(false);
            $table->boolean('is_staff_only')->default(false);
            $table->boolean('allow_users_to_claim_rewards')->default(false);
        });

        Schema::create('boss_rewards', function (Blueprint $table) {
            $table->foreignId('boss_id')->constrained()->onDelete('cascade');
            $table->string('rewardable_type');
            $table->unsignedBigInteger('rewardable_id');
            $table->integer('quantity');
            $table->integer('threshold')->default(0);
        });

        Schema::create('user_boss_attacks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreignId('boss_id')->constrained()->onDelete('cascade');
            $table->string('attack_method')->nullable()->default(null);
            $table->integer('damage')->default(0);
            $table->json('data')->nullable()->default(null);

            $table->timestamps();
        });

        // general logs for things like rewards, etc, and for any future data that needs to be stored
        Schema::create('user_boss_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreignId('boss_id')->constrained()->onDelete('cascade');
            $table->json('data')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('user_boss_logs');
        Schema::dropIfExists('user_boss_attacks');
        Schema::dropIfExists('boss_rewards');
        Schema::dropIfExists('bosses');
    }
};
