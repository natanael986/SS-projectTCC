<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsReports extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'reason',
        'comment_id',
        'user_id',
    ];
}
