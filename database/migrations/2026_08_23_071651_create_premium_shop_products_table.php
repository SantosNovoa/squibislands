<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumShopProductsTable extends Migration
{
    public function up()
    {
        Schema::create('premium_shop_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->unsigned(); // in cents, e.g. 500 = $5.00
            $table->string('rewardable_type'); // 'Currency' or 'Item'
            $table->integer('rewardable_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('sort')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('premium_shop_products');
    }
}
