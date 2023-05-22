<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\PostsLikes;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function like(Posts $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            $post->likes()->create([
                'user_id' => auth()->id(),
                'status' => 'liked'
            ]);
        } elseif ($like->status == 'liked') {
            $like->update(['status' => 'unliked']);
        } else {
            $like->update(['status' => 'liked']);
        }

        $likesCount = $post->likes()->where('status', 'liked')->count();
        $dislikesCount = $post->likes()->where('status', 'disliked')->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'userStatus' => $like ? $like->status : null,
        ]);
    }

    public function dislike(Posts $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            $post->likes()->create([
                'user_id' => auth()->id(),
                'status' => 'disliked'
            ]);
        } elseif ($like->status == 'disliked') {
            $like->update(['status' => 'unliked']);
        } else {
            $like->update(['status' => 'disliked']);
        }

        $likesCount = $post->likes()->where('status', 'liked')->count();
        $dislikesCount = $post->likes()->where('status', 'disliked')->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'userStatus' => $like ? $like->status : null,
        ]);
    }


    public function destroy($id)
    {
        PostsLikes::findOrFail($id)->delete();

        return redirect()->route('site.home')->with('success', 'Comment excluido com sucesso!');
    }
}
