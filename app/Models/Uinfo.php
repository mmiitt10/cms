<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uinfo extends Model
{
    use HasFactory;
    
    // プロフィールが紐づいているユーザーを取得
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
