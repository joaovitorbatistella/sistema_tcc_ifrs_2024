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
        Schema::create('user_class', function (Blueprint $table) {
            $table->bigIncrements('user_class_id');
            $table->unsignedBigInteger('tcc_class_id');
            $table->unsignedBigInteger('userd_id');
            $table->foreign('tcc_class_id')->references('tcc_class_id')->on('tcc_class');
            $table->foreign('userd_id')->references('id')->on('users');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_class');
    }
};
