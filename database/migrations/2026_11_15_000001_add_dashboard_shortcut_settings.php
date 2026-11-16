<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        // One on/off setting per dashboard shortcut (also editable from Site Settings)
        foreach (['dailies' => 'Dailies', 'shops' => 'Shops', 'prompts' => 'Prompts', 'inventory' => 'Inventory'] as $key => $label) {
            if (!DB::table('site_settings')->where('key', 'dashboard_shortcut_'.$key.'_active')->exists()) {
                DB::table('site_settings')->insert([
                    'key'         => 'dashboard_shortcut_'.$key.'_active',
                    'value'       => 1,
                    'description' => '0: '.$label.' shortcut hidden on the dashboard, 1: shown. If every shortcut is hidden, Recent News takes the full width.',
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        DB::table('site_settings')->where('key', 'like', 'dashboard_shortcut_%_active')->delete();
    }
};
