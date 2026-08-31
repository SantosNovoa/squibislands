<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('character_image_titles', function (Blueprint $table) {
            $table->boolean('is_visible')->default(1)->after('sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('character_image_titles', function (Blueprint $table) {
            $table->dropColumn('is_visible');
        });
    }
};
