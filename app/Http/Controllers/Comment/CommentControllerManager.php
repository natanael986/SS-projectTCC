<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CommentControllerManager extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comments;

        $comment->post_id = $request->post_id;
        $comment->name = auth()->user()->name_id;
        $comment->user_id = auth()->user()->id;
        // $comment->image = auth()->user()->image;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->route('Inicio')->with('success', 'Publicação realizada com sucesso!');
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
    public function edit( $id)
    {
        $routeName = Route::currentRouteName();


        // Responsavel por editar o conteudo selecionado
        $comments = Comments::findOrFail($id);
        $posts = Posts::all();
        $users = User::all();

        return view('site.commentmanager.edit', compact('posts', 'users', 'comments', 'routeName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'comment' => 'required',
        ]);

        $data = $request->all();

        Comments::findOrFail($id)->update($data);

        return redirect()->route('Inicio')->with('success', 'Comentário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Comments::findOrFail($id)->delete();

        return redirect()->route('Inicio')->with('success', 'Comment excluido com sucesso!');
    }
}
