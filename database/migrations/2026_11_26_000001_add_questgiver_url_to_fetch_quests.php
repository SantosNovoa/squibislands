<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Optional link for the questgiver's name on fetch quest cards (e.g. an NPC's page).
     */
    public function up(): void {
        Schema::table('fetch_quests', function (Blueprint $table) {
            $table->string('questgiver_url')->nullable()->default(null)->after('questgiver_name');
        });
    }

    public function down(): void {
        Schema::table('fetch_quests', function (Blueprint $table) {
            $table->dropColumn('questgiver_url');
        });
    }
};
