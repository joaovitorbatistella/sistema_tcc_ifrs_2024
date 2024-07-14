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
        Schema::create('user_class_activity_append', function (Blueprint $table) {
            $table->unsignedBigInteger('user_class_activity_id');
            $table->unsignedBigInteger('append_id');

            $table->primary(['user_class_activity_id', 'append_id']);
            $table->foreign('user_class_activity_id')->references('user_class_activity_id')->on('user_class_activity');
            $table->foreign('append_id')->references('append_id')->on('append');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_class_activity_append');
    }
};
