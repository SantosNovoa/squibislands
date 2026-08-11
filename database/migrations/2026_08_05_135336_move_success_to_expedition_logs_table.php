<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveSuccessToExpeditionLogsTable extends Migration
{
    public function up()
    {
        Schema::table('expedition_logs', function (Blueprint $table) {
            $table->boolean('success')->nullable()->after('is_processed');
        });

        Schema::table('expedition_log_character', function (Blueprint $table) {
            $table->dropColumn('success');
        });
    }

    public function down()
    {
        Schema::table('expedition_logs', function (Blueprint $table) {
            $table->dropColumn('success');
        });

        Schema::table('expedition_log_character', function (Blueprint $table) {
            $table->boolean('success')->nullable();
        });
    }
}