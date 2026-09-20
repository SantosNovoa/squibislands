<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransferReason extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransferReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        // Add columns
        Schema::table('character_transfers', function (Blueprint $table) {
            $table->string('user_reason', 200)->nullable($value = true);
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
        Schema::table('character_transfers', function (Blueprint $table) {
            //
            $table->dropColumn('user_reason');
        });
    }
}
