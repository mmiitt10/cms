<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    // 書籍情報を有しているユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
