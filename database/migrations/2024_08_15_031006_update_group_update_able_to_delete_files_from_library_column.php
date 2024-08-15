<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('library_column', function (Blueprint $table) {
            DB::statement("
                UPDATE tcc_ifrs.`group`
                    SET able_to_delete_files_from_library=1
                    WHERE group_id IN (1,2);
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('library_column', function (Blueprint $table) {
            DB::statement("
                UPDATE tcc_ifrs.`group`
                    SET able_to_delete_files_from_library=0
                    WHERE group_id IN (1,2);
            ");
        });
    }
};
