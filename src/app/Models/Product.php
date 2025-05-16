<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 保存可能な属性（ホワイトリスト）
    protected $fillable = ['name', 'price', 'description', 'image'];

    /**
     * 多対多リレーション：Product <-> Season
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class)->withTimestamps(); // 中間テーブルを使用
    }

}