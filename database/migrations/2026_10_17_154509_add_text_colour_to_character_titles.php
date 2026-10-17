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
        Schema::table('character_titles', function (Blueprint $table) {
            $table->string('text_colour', 7)->nullable()->default(null)->after('colours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('character_titles', function (Blueprint $table) {
            $table->dropColumn('text_colour');
        });
    }
};