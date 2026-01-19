<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAcceptedTerms extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        //
        Schema::table('users', function(Blueprint $table) {
            $table->boolean('has_accepted_terms')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        //
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('has_accepted_terms');
        });

    }
}
