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
        Schema::create('append', function (Blueprint $table) {
            $table->bigIncrements('append_id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->boolean('public');
            $table->string('path');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('append_type_id')->on('append_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('append');
    }
};
