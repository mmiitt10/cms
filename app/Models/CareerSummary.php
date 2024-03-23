<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSummary extends Model
{
    /**
     * このモデルが関連付けられているテーブルの名前。
     *
     * @var string
     */
    protected $table = 'career_summaries';

    /**
     * マスアサインメントで使用可能な属性。
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'total_years',
    ];

    /**
     * このキャリアサマリーが属するユーザーモデル。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}