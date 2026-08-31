<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('premium_shop_purchases', function (Blueprint $table) {
            // adds non nullabe double column placed after the stripe_payment column
            $table->double('cost')->nullable(false)->default(0)->after('stripe_payment_intent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('premium_shop_purchases', function (Blueprint $table) {
            // drops the column when rolled back
            $table->dropColumn('cost');
        });
    }
};
