<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetGallerySubmissionHashNullable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetGallerySubmissionHashNullable extends Migration
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
        Schema::table('gallery_submissions', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('extension');
        });

        Schema::table('gallery_submissions', function (Blueprint $table) {
            $table->string('hash', 10)->nullable();
            $table->string('extension', 5)->nullable();
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
        Schema::table('gallery_submissions', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('extension');
        });

        Schema::table('gallery_submissions', function (Blueprint $table) {
            $table->string('hash', 10);
            $table->string('extension', 5);
        });
    }
}
