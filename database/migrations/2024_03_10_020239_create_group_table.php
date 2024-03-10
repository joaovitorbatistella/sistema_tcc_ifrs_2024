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
        Schema::create('group', function (Blueprint $table) {
            $table->integer('group_id')->autoIncrement();
            $table->string('name');
            $table->boolean('able_to_create_tcc')->default(false);
            $table->boolean('able_to_read_tcc')->default(false);
            $table->boolean('able_to_update_tcc')->default(false);
            $table->boolean('able_to_delete_tcc')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group');
    }
};
