<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSenderRecipientTypeToCharacterItemsLog extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
=======
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSenderRecipientTypeToCharacterItemsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        Schema::table('character_items_log', function (Blueprint $table) {
            //Add sender and recipient type
            $table->enum('sender_type', ['User', 'Character'])->nullable()->default(null);
            $table->enum('recipient_type', ['User', 'Character'])->nullable()->default(null);
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
        Schema::table('character_items_log', function (Blueprint $table) {
            //
            $table->dropColumn('sender_type');
            $table->dropColumn('recipient_type');
        });
    }
}
