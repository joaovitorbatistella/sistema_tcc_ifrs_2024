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
        Schema::create('tcc', function (Blueprint $table) {
            $table->unsignedBigInteger('tcc_id')->autoIncrements()->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->enum('status', ['in_progress', 'stopped', 'approved', 'completed']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tcc');
        Schema::enableForeignKeyConstraints();
    }
};
