<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Replace the free-text contact box with a list of website/URL links.
     */
    public function up(): void {
        Schema::table('custom_artist_profiles', function (Blueprint $table) {
            $table->text('contacts')->nullable()->after('is_redesign_open');
        });

        Schema::table('custom_artist_profiles', function (Blueprint $table) {
            $table->dropColumn(['contact', 'parsed_contact']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('custom_artist_profiles', function (Blueprint $table) {
            $table->text('contact')->nullable()->after('is_redesign_open');
            $table->text('parsed_contact')->nullable()->after('contact');
        });

        Schema::table('custom_artist_profiles', function (Blueprint $table) {
            $table->dropColumn('contacts');
        });
    }
};