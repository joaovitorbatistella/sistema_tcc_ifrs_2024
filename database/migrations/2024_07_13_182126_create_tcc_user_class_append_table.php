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
        Schema::create('tcc_user_class_append', function (Blueprint $table) {
            $table->bigIncrements('tcc_user_class_append_id');
            $table->unsignedBigInteger('append_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('append_id')->references('append_id')->on('append');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tcc_user_class_append');
    }
};
