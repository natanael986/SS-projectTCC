<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\CommentsReports;
use App\Models\Posts;
use App\Models\PostsReports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CommentReportControllerManager extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $routeName = Route::currentRouteName();

        $comments = Comments::findOrFail($id);
        $comment_reports = CommentsReports::all();
        $users = User::all();
        return view('site.reportmanager.create2', compact('users', 'comments', 'comment_reports', 'routeName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CommentsReports $comment_reports)
    {
        $request->validate([
            'reason' => 'required',

        ]);

        $comment_reports->comment_id = $request->comment_id;
        $comment_reports->reason = $request->reason;
        $comment_reports->user_id = auth()->user()->id;
        $comment_reports->name = auth()->user()->name_id;
        $comment_reports->save();
        return redirect()->route('Inicio')->with('success', 'Comentário reportado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $routeName = Route::currentRouteName();

        $comments = Comments::all();
        $posts = Posts::all();
        $comment_reports = CommentsReports::findOrFail($id);
        $users = User::all();
        return view('site.reportmanager.show2', compact('posts', 'users', 'comments', 'comment_reports', 'routeName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        CommentsReports::findOrFail($id)->delete();

        return redirect()->route('reportmanager.index')->with('success', 'Comment excluido com sucesso!');
    }
}
