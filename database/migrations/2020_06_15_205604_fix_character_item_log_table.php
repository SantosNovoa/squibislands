<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCharacterItemLogTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCharacterItemLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::statement('ALTER TABLE character_items_log CHANGE `count` `quantity` INT(10) unsigned;');

        Schema::table('character_items_log', function (Blueprint $table) {
            $table->integer('stack_id')->unsigned()->nullable()->change();
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
        DB::statement('ALTER TABLE character_items_log CHANGE `quantity` `count` INT(10) unsigned;');

        Schema::table('character_items_log', function (Blueprint $table) {
            $table->integer('stack_id')->unsigned()->change();
        });
<<<<<<< HEAD
=======
        
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
