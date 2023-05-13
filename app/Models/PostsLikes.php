<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsLikes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'posts_id', 'status'];

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
