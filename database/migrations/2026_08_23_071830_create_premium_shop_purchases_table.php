<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumShopPurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('premium_shop_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('stripe_payment_intent_id')->unique();
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('premium_shop_products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('premium_shop_purchases');
    }
}