<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToComments extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->string('type')->default('User-User');
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->string('type')->default("User-User");
>>>>>>> Cylunny/extension/polls-and-forms
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
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->dropColumn('type');
        });
    }
}
