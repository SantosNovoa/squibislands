<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_links', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        DB::table('site_links')->insert([
            'key'        => 'discord',
            'url'        => null, // or paste your current invite here
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_links');
    }
};