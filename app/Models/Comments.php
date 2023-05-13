<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'user_id',
        'image',
        'post_id'
    ];



    public function likes()
    {
        return $this->hasMany(CommentsLikes::class);
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
