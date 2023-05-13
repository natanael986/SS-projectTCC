<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BannedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function banned($id)
    {
        //ESSA FUNÇÃO SERVE PARA BANIR OS USUÁRIOS
        $user = User::findOrFail($id);
        if ($user->banned != true) {
            $user->banned = true;
        } else {
            $user->banned = false;
        }
        $user->save();

        return redirect()->route('Denúncias')->with('success', 'Comment excluido com sucesso!');
    }

    public function estaBanido($id)
    {
        //VERIFICA SE O USUÁRIO ESTÁ BANIDO
        $user = User::findOrFail($id);
        return $this->$user->banned;
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
