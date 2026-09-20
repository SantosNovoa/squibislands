<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixGalleryTables extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixGalleryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        //
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->dropColumn('sort');
        });

        // Drop data columns so that they can be made into their own tables
        // so that relations work nicely
        Schema::table('gallery_submissions', function (Blueprint $table) {
            //
            $table->dropColumn('collaborator_data');
            $table->dropColumn('character_data');
        });

        // Add table for attached characters...
        Schema::create('gallery_submission_characters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gallery_submission_id')->unsigned()->index();
            $table->integer('character_id')->unsigned()->index();
        });

        // ...and collaborators
        Schema::create('gallery_submission_collaborators', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gallery_submission_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();

            $table->boolean('has_approved')->default(0);
            $table->string('data', 512)->nullable()->default(null);
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
        //
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->integer('sort')->unsigned();
        });

        Schema::table('gallery_submissions', function (Blueprint $table) {
            //
            $table->string('collaborator_data', 1024)->nullable()->default(null);
            $table->string('character_data', 1024)->nullable()->default(null);
        });

        Schema::dropIfExists('gallery_submission_characters');
        Schema::dropIfExists('gallery_submission_collaborators');
    }
}
