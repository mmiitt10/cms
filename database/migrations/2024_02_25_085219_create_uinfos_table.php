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
        Schema::create('uinfos', function (Blueprint $table) {
            $table->bigIncrements('id'); // プライマリキーのカラム名を'id'に変更
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('profile_name');
            $table->integer('profile_age')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('profile_intro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uinfos');
    }
};
