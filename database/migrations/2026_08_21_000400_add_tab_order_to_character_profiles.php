<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTabOrderToCharacterProfiles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('character_profiles', function (Blueprint $table) {
            $table->json('items_tab_order')->nullable();
            $table->json('info_tab_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('character_profiles', function (Blueprint $table) {
            $table->dropColumn(['items_tab_order', 'info_tab_order']);
        });
    }
}
