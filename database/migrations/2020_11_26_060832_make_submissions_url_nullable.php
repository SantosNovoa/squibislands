<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;

class MakeSubmissionsUrlNullable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        //
        DB::statement('ALTER TABLE submissions CHANGE url url VARCHAR(200) NULL');
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSubmissionsUrlNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE submissions CHANGE url url VARCHAR(200) NULL');

>>>>>>> Cylunny/extension/polls-and-forms
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
        DB::statement('ALTER TABLE submissions CHANGE url url VARCHAR(200)');
    }
}
