<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class AddSelectPromptToGalleries extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
class AddSelectPromptToGalleries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->boolean('prompt_selection')->default(0);
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
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->dropColumn('prompt_selection');
        });
    }
}
