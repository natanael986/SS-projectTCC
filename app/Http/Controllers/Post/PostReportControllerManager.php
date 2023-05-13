<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\CommentsReports;
use App\Models\Posts;
use App\Models\PostsReports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PostReportControllerManager extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $routeName = Route::currentRouteName();

        $posts = Posts::all();
        $post_reports = PostsReports::all();
        $comment_reports = CommentsReports::all();

        $comments = DB::table('comments')->get();
        $users = DB::table('users')->get();

        return view('site.reportmanager.index', compact('posts', 'comments', 'post_reports', 'comment_reports', 'users', 'routeName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $routeName = Route::currentRouteName();

        $posts = Posts::findOrFail($id);
        $post_reports = PostsReports::all();
        $users = User::all();
        $comments = Comments::all();
        return view('site.reportmanager.create', compact('posts', 'users', 'comments', 'post_reports', 'comments', 'routeName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostsReports $post_reports, Posts $post)
    {
        $request->validate([
            'reason' => 'required',

        ]);
        $post_reports->post_id = $request->post_id;
        $post_reports->reason = $request->reason;
        $post_reports->user_id = auth()->user()->id;
        $post_reports->name = auth()->user()->name_id;
        $post_reports->save();
        return redirect()->route('Inicio')->with('success', 'Publicação realizada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $routeName = Route::currentRouteName();

        $posts = Posts::all();
        $post_reports = PostsReports::findOrFail($id);
        $comments = Comments::all();
        $comment_reports = CommentsReports::all();
        $users = User::all();
        return view('site.reportmanager.show', compact('posts', 'users', 'post_reports', 'comments', 'comment_reports', 'routeName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $routeName = Route::currentRouteName();
        $users = User::findOrFail($id);


        return view('site.reportmanager.edit', compact('users','routeName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        PostsReports::findOrFail($id)->delete();

        return redirect()->route('Denúncias')->with('success', 'Comment excluido com sucesso!');
    }
}
