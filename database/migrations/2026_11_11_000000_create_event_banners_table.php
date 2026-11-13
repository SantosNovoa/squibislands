<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEventBannersTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('event_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('link', 255)->nullable()->default(null);
            $table->boolean('show_name')->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('sort')->unsigned()->default(0);
            $table->string('hash', 10)->nullable()->default(null);
            $table->string('extension', 5)->nullable()->default(null);
            $table->timestamps();
        });

        // Global on/off switch for the dashboard banner (also editable from Site Settings)
        if (!DB::table('site_settings')->where('key', 'event_banner_enabled')->exists()) {
            DB::table('site_settings')->insert([
                'key'         => 'event_banner_enabled',
                'value'       => 1,
                'description' => '0: Event banner hidden on the dashboard, 1: Event banner shown (if any banners are active).',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('event_banners');
        DB::table('site_settings')->where('key', 'event_banner_enabled')->delete();
    }
}
