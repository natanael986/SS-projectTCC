<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\CommentsLikes;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function like(Comments $comment)
    {
        $like = $comment->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            $comment->likes()->create([
                'user_id' => auth()->id(),
                'status' => 'liked'
            ]);
        } elseif ($like->status == 'liked') {
            $like->update(['status' => 'unliked']);
        } else {
            $like->update(['status' => 'liked']);
        }

        $likesCount = $comment->likes()->where('status', 'liked')->count();
        $dislikesCount = $comment->likes()->where('status', 'disliked')->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'userStatus' => $like ? $like->status : null,
        ]);
    }

    public function dislike(Comments $comment)
    {
        $like = $comment->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            $comment->likes()->create([
                'user_id' => auth()->id(),
                'status' => 'disliked'
            ]);
        } elseif ($like->status == 'disliked') {
            $like->update(['status' => 'unliked']);
        } else {
            $like->update(['status' => 'disliked']);
        }

        $likesCount = $comment->likes()->where('status', 'liked')->count();
        $dislikesCount = $comment->likes()->where('status', 'disliked')->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'userStatus' => $like ? $like->status : null,
        ]);
    }

    public function destroy($id)
    {
        CommentsLikes::findOrFail($id)->delete();

        return redirect()->route('site.home')->with('success', 'Comment excluido com sucesso!');
    }
}
