<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PostControllerManager extends Controller
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
        //ELA VAI PARA A PAGINA DE CRIAR PUBLICAÇÕES
        $routeName = Route::currentRouteName();
        return view('site.postmanager.create', compact('routeName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ELA VAI SALVAR A PUBLICAÇÃO NO BANCO DE DADOS
        $request->validate([
            'tittle' => 'required',
            'publication' => 'required',
            'context' => 'required',
            'appropriate' => 'required',

        ]);

        $posts = new Posts;

        $posts->name = auth()->user()->name_id;
        $posts->user_id = auth()->user()->id;
        $posts->tittle = $request->tittle;
        $posts->appropriate = $request->appropriate;
        $posts->context = $request->context;
        $posts->publication = $request->publication;
        $posts->save();

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
    public function edit($id)
    {
        //ELE VAI PARA A PAGINA DE EDITAR PUBLICAÇÕES
        $posts = Posts::findOrFail($id);
        $routeName = Route::currentRouteName();

        return view('site.postmanager.edit', compact('posts', 'routeName'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //ELA VAI ATUALIZAR A PUBLICAÇÃO NO BANCO DE DADOS
        $request->validate([
            'tittle' => 'required',
            'publication' => 'required',
            'context' => 'required',
            'appropriate' => 'required',
        ]);

        $data = $request->all();

        Posts::findOrFail($id)->update($data);

        return redirect()->route('Inicio')->with('success', 'Publicação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //ELA VAI EXCLUIR A PUBLICAÇÃO NO BANCO DE DADOS
        $posts = Posts::findOrFail($id)->delete();
        $posts->registrations()->delete();
        $posts->delete();

        return redirect()->route('Inicio')->with('success', 'Publicação excluida com sucesso!');

    }
}
