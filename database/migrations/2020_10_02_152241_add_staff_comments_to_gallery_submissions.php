<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStaffCommentsToGallerySubmissions extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaffCommentsToGallerySubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('gallery_submissions', function (Blueprint $table) {
            //
            $table->text('staff_comments')->nullable();
            $table->text('parsed_staff_comments')->nullable();
            $table->integer('staff_id')->unsigned()->nullable();
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
        Schema::table('gallery_submissions', function (Blueprint $table) {
            //
            $table->dropColumn('staff_comments');
            $table->dropColumn('parsed_staff_comments');
            $table->dropColumn('staff_id');
        });
    }
}
