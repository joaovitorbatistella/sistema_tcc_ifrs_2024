<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('countries', function (Blueprint $table){
            $table->char('id',2)->primary();
            $table->char('name',60);
            $table->char('phoneCode',10);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
      }

    /**
     * Reverse the migrations.
     */
      public function down() {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('countries');
        Schema::enableForeignKeyConstraints();
      }
};
