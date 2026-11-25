<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Remove prompt/gallery/default criterion rows that point at criteria which no longer exist.
     * (Deleting a criterion used to leave these behind, which crashed the prompt edit page.)
     */
    public function up(): void {
        foreach (['prompt_criteria', 'gallery_criteria', 'default_criteria'] as $table) {
            DB::table($table)
                ->whereNotIn('criterion_id', DB::table('criteria')->select('id'))
                ->delete();
        }
    }

    /**
     * Orphaned rows can't be restored.
     */
    public function down(): void {
        //
    }
};
