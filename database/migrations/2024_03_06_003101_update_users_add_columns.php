<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('enrollment')->nullable()->default(null);
            $table->enum('course', ['Ciência da Computação'])->nullable()->default(null);
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->datetime('birthday')->nullable()->default(null);
            $table->string('nationality')->nullable()->default(null);
            $table->string('special_need')->nullable()->default(null);
            $table->enum('martial_status', ['single', 'married', 'separated', 'divorced', 'widowed'])->nullable()->default(null);
            $table->string('cpf', 11);
            $table->string('rg', 10);
            $table->json('voter')->nullable()->default(new Expression('(JSON_ARRAY())'))->comment('Use to store voter id and voter zone');
            $table->json('military')->nullable()->default(new Expression('(JSON_ARRAY())'))->comment('Use to store military info');           
            $table->json('phones')->nullable()->default(new Expression('(JSON_ARRAY())'));
            $table->decimal('family_income', $precision = 12, $scale = 2)->nullable()->default(null);
            $table->integer('family_number')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('enrollment');
            $table->dropColumn('course');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('nationality');
            $table->dropColumn('special_need');
            $table->dropColumn('martial_status');
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
            $table->dropColumn('voter');
            $table->dropColumn('military');
            $table->dropColumn('phones');
            $table->dropColumn('family_income');
            $table->dropColumn('family_number');
        });
    }
};
