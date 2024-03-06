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
        Schema::create('careers', function (Blueprint $table) {
            $table->bigIncrements('id'); // プライマリキーのカラム名を'id'に変更
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('career_company');
            $table->date('career_work_from');
            $table->date('career_work_to');
            $table->string('career_industry');
            $table->string('career_function');
            $table->string('career_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
