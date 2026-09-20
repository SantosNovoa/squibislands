<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RaiseCurrenciesLogLogCharacterLimit extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RaiseCurrenciesLogLogCharacterLimit extends Migration
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
        Schema::table('currecies_log', function (Blueprint $table) {
            DB::statement('ALTER TABLE currencies_log MODIFY COLUMN log VARCHAR(255)');
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
        Schema::table('currencies_log', function (Blueprint $table) {
            DB::statement('ALTER TABLE currencies_log MODIFY COLUMN log VARCHAR(191)');
        });
    }
}
