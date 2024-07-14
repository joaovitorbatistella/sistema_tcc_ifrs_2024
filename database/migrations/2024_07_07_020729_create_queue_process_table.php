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
        Schema::create('queue_process', function (Blueprint $table) {
            $table->integer('queue_id')->autoIncrement();
            $table->char('queue_uid', 13);
            $table->string('batch_id', 255)->nullable();
            $table->char('ip', 12)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('queue', 50)->nullable();
            $table->binary('data')->nullable();
            $table->char('status', 15)->nullable();
            $table->text('progress')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            
            // Indexes
            $table->index('class_id');
            $table->index('user_id');
            
            // Foreign keys
            $table->foreign('class_id')->references('tcc_class_id')->on('tcc_class')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('batch_id')->references('id')->on('job_batches')->onDelete('set null')->onUpdate('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_process');
    }
};
