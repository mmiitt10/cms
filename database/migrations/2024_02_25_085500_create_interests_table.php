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
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id'); // プライマリキーのカラム名を'id'に変更
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('interest_industry1');
            $table->string('interest_industry2');
            $table->string('interest_industry3');
            $table->string('interest_function1');
            $table->string('interest_function2');
            $table->string('interest_function3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
