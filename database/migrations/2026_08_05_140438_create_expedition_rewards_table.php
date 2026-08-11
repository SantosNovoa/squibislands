<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpeditionRewardsTable extends Migration
{
    public function up()
    {
        Schema::create('expedition_rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expedition_id');
            $table->string('rewardable_type');
            $table->unsignedInteger('rewardable_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->foreign('expedition_id')->references('id')->on('expeditions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('expedition_rewards');
    }
}