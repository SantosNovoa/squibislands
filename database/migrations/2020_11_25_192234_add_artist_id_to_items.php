<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtistIdToItems extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArtistIdToItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('items', function (Blueprint $table) {
            //
            $table->integer('artist_id')->unsigned()->nullable();
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
        Schema::table('items', function (Blueprint $table) {
            //
            $table->dropColumn('artist_id');
        });
    }
}
