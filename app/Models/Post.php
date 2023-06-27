<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
