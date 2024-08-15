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
        DB::statement("
            UPDATE tcc_ifrs.`group`
                SET able_to_create_users=1
                WHERE group_id IN (1,2,3);
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            UPDATE tcc_ifrs.`group`
                SET able_to_create_users=0
                WHERE group_id IN (1,2,3);
        ");
    }
};
