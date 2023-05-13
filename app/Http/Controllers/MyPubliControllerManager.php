<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CommentsLikes;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MyPubliControllerManager extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $posts = Posts::where('user_id', $user_id)->get();

        $likes = CommentsLikes::all();

        $comments = Comments::all();

        $user = User::all();

        $users = DB::table('users')->get();

        $routeName = Route::currentRouteName();

        return view('site.mypublimanager.index', compact('posts', 'comments', 'users', 'likes', 'user', 'routeName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }
}
