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
        Schema::create('user_group', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('group_id');
            $table->timestamps();
            $table->primary(['user_id', 'group_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('group_id')->on('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_group');
    }
};
