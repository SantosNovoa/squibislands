<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeItemTrackingSystem extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeItemTrackingSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::statement('ALTER TABLE user_items CHANGE `holding_count` `trade_count` INT(10) unsigned;');

        Schema::table('user_items', function (Blueprint $table) {
            $table->unsignedInteger('update_count')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
<<<<<<< HEAD
     */
    public function down() {
=======
     *
     * @return void
     */
    public function down()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::statement('ALTER TABLE user_items CHANGE `trade_count` `holding_count` INT(10) unsigned;');

        Schema::table('user_items', function (Blueprint $table) {
            $table->dropColumn('update_count');
        });
    }
}
