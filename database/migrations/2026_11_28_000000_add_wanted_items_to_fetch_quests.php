<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        // Items an admin has chosen for a fetch quest to ask for, each with an amount range
        Schema::create('fetch_quest_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('fetch_quest_id')->unsigned()->index();
            $table->integer('item_id')->unsigned();
            $table->integer('min_quantity')->unsigned()->default(1);
            $table->integer('max_quantity')->unsigned()->default(1);
        });

        // How many of the current fetch item the quest is asking for
        Schema::table('fetch_quests', function (Blueprint $table) {
            $table->integer('fetch_quantity')->unsigned()->default(1)->after('fetch_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fetch_quest_items');

        Schema::table('fetch_quests', function (Blueprint $table) {
            $table->dropColumn('fetch_quantity');
        });
    }
};
