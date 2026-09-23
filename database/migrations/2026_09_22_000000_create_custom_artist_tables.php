<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        // Individual users allowed to post an entry even if their rank lacks the power
        Schema::create('custom_artist_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->unique();
            $table->unsignedInteger('granted_by')->nullable();
            $table->timestamps();
        });

        // One entry per artist
        Schema::create('custom_artist_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->unique();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_custom_open')->default(0);
            $table->boolean('is_rebase_open')->default(0);
            $table->boolean('is_redesign_open')->default(0);
            $table->text('contact')->nullable();
            $table->text('parsed_contact')->nullable();
            $table->text('notes')->nullable();
            $table->text('parsed_notes')->nullable();
            $table->timestamps();
        });

        // Named, priced options under each type (custom / rebase / redesign)
        Schema::create('custom_artist_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->index();
            $table->string('type', 20);
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('currency_id')->nullable(); // null = USD
            $table->boolean('is_active')->default(1);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('custom_artist_options');
        Schema::dropIfExists('custom_artist_profiles');
        Schema::dropIfExists('custom_artist_access');
    }
};
