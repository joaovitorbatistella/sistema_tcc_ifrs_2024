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
        Schema::create('activity_step_template', function (Blueprint $table) {
            $table->increments('activity_step_template_id');
            $table->unsignedInteger('activity_template_id');
            $table->string('name');
            $table->foreign('activity_template_id')->references('activity_template_id')->on('activity_template');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('activity_step_template');
        Schema::enableForeignKeyConstraints();
    }
};
