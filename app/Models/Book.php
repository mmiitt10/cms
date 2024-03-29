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
    
    // 返信情報を複数保持可能
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
    // likeに対して紐づけ
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    // いいねの判別
    public function isLikedByAuthUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

}
