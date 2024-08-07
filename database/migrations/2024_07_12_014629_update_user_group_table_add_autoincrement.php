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
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::statement("ALTER TABLE user_group MODIFY COLUMN user_id bigint(20) unsigned auto_increment NOT NULL");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
