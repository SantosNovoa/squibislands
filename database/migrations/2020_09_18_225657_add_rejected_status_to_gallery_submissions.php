<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;

class AddRejectedStatusToGallerySubmissions extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRejectedStatusToGallerySubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::statement("ALTER TABLE gallery_submissions CHANGE COLUMN status status ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending'");
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
        DB::statement("ALTER TABLE gallery_submissions CHANGE COLUMN status status ENUM('Pending', 'Accepted') DEFAULT 'Pending'");
    }
}
