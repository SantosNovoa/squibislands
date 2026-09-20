<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubMasterlist extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubMasterlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('character_categories', function (Blueprint $table) {
            //adds a setting on character categories which moves those characters to a second masterlist
            //this allows for an NPC masterlist, or a PET masterlist, or a MNT (mount) masterlist
            //0 is main masterlist
            $table->integer('masterlist_sub_id')->default(0);
        });

        Schema::table('specieses', function (Blueprint $table) {
            //adds a setting on species which moves those species to a second masterlist
            //this allows for an NPC masterlist, or a PET masterlist, or a MNT (mount) masterlist
            //0 is main masterlist
            $table->integer('masterlist_sub_id')->default(0);
        });

        //
        Schema::create('masterlist_sub', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('key');
            $table->integer('show_main')->default(0); //whether or not its characters show up on the main masterlist
            $table->integer('sort')->unsigned()->default(0);
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
        Schema::table('character_categories', function (Blueprint $table) {
            //
            $table->dropColumn('masterlist_sub_id');
        });
<<<<<<< HEAD

=======
        
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('specieses', function (Blueprint $table) {
            //
            $table->dropColumn('masterlist_sub_id');
        });

        //
        Schema::dropIfExists('masterlist_sub');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> Cylunny/extension/polls-and-forms
