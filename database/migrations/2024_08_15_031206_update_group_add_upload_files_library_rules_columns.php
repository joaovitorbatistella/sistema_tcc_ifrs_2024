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
        Schema::table('group', function (Blueprint $table) {
            $table->boolean('able_to_upload_files_library')->after('able_to_delete_files_from_library')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group', function (Blueprint $table) {
            $table->dropColumn('able_to_upload_files_library');
        });
    }
};
