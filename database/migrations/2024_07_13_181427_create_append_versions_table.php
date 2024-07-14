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
        Schema::create('append_versions', function (Blueprint $table) {
            $table->bigIncrements('version_id');
            $table->unsignedBigInteger('append_id');
            $table->string('path');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('append_id')->references('append_id')->on('append');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('append_versions');
    }
};
