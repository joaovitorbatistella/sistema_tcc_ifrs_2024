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
        Schema::create('user_class_activity', function (Blueprint $table) {
            $table->bigIncrements('user_class_activity_id');
            $table->unsignedBigInteger('user_class_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->date('due_date')->nullable();
            $table->date('delivered_at')->nullable();
            $table->timestamps();
            $table->foreign('user_class_id')->references('user_class_id')->on('user_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_class_activity');
        Schema::enableForeignKeyConstraints();
    }
};
