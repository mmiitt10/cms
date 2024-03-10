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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id'); // プライマリキーのカラム名を'id'に変更
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('ssbid'); // SSBID
            $table->string('status'); // ステータス
            $table->integer('assessment'); // 評価
            $table->text('comment')->nullable(); // コメント（NULL許可）
            $table->timestamps(); // 作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
