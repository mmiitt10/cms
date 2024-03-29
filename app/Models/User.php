<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // ユーザーに紐づくプロフィールを取得
    public function uinfo()
    {
        return $this->hasOne(Uinfo::class, 'user_id');
    }

    // ユーザーに紐づく興味・関心を取得
    public function interest()
    {
        return $this->hasOne(Interest::class, 'user_id');
    }

    // ユーザーに紐づくキャリアを取得
    public function career()
    {
        return $this->hasMany(Career::class, 'user_id')->orderBy('career_work_from','desc');
    }
    
    
    // ユーザーに紐づく書籍情報を取得
    public function book()
    {
        return $this->hasMany(Book::class, 'user_id');
    }
        
    // フォローしているユーザー
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }
    
    // フォローされているユーザー（フォロワー）
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }
    
    // フォローしているかどうかを確かめる
    public function isFollowing($userId)
    {
        return $this->following()->where('followed_id', $userId)->exists();
    }
}
