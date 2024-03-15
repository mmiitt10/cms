<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->text('comment'); // 返信の内容
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // 投稿への外部キー
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーへの外部キー
            $table->timestamps(); // 作成日時と更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
