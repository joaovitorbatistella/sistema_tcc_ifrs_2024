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
        Schema::table('user_class_activity', function (Blueprint $table) {
            $table->dropColumn('due_date');
            $table->dropColumn('delivered_at');
        });

        Schema::table('user_class_activity', function (Blueprint $table) {
            $table->dateTime('due_at')->after('description')->nullable();
        });

        Schema::table('user_class_activity', function (Blueprint $table) {
            $table->dateTime('delivered_at')->after('due_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_class_activity', function (Blueprint $table) {
            $table->date('due_date')->nullable();
            $table->date('delivered_at')->nullable();
        });
    }
};
