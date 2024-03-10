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
        Schema::create('tcc_class', function (Blueprint $table) {
            $table->bigIncrements('tcc_class_id');
            $table->unsignedInteger('tcc_type_id');
            $table->unsignedBigInteger('tcc_id');
            $table->enum('status', ['in_progress', 'stopped', 'cancelled', 'completed']);
            $table->timestamps();
            $table->foreign('tcc_type_id')->references('tcc_type_id')->on('tcc_type');
            $table->foreign('tcc_id')->references('tcc_id')->on('tcc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tcc_class');
    }
};
