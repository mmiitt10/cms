<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    
    // 返信は1つの投稿に紐づく
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    // 返信は1人のユーザーに紐づく
    public function user()
    {
        return $this->belongsTo(User::class);
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
