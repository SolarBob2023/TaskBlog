<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $with = ['user'];
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
