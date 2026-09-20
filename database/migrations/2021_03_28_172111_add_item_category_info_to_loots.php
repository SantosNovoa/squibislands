<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class AddItemCategoryInfoToLoots extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
class AddItemCategoryInfoToLoots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('loots', function (Blueprint $table) {
            //
            $table->string('data')->nullable()->default(null);
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
        Schema::table('loots', function (Blueprint $table) {
            //
            $table->dropColumn('data');
        });
    }
}
