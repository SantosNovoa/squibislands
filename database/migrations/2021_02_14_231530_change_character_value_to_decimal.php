<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class ChangeCharacterValueToDecimal extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
class ChangeCharacterValueToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('characters', function (Blueprint $table) {
            $table->decimal('sale_value', 13, 2)->default(0.00)->change();
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
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('sale_value')->nullable(false)->default(0)->change();
        });
    }
}
