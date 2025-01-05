<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'content',
        'due_date',
        'user_id',
    ];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //カテゴリーとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //カテゴリーごとのTodoの検索機能のための設定
    public function scopeCategorySearch($query,$category_id)
    {
        if(!empty($category_id)){
            $query->where('category_id',$category_id);
        }
    }
    
}
