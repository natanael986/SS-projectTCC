<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'name',
        'tittle',
        'publication',
        'comment',
        'context',
        'user_id',
        'appropriate'
    ];

    public function likes()
    {
        return $this->hasMany(PostsLikes::class);
    }

    public function likesCount()
    {
        return $this->likes()->where('status', 'liked')->count();
    }

    public function unlikesCount()
    {
        return $this->likes()->where('status', 'unliked')->count();
    }

    public function dislikesCount()
    {
        return $this->likes()->where('status', 'disliked')->count();
    }
}
