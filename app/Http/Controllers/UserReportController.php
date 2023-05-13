<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UserReportController extends Controller
{
    public function index()
    {
        $search = request('search');

        $routeName = Route::currentRouteName();


        // PESQUISA COMPLETA
        if ($search) {
            $users = User::where([
                ['name_id', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $users = User::all();
        }

        $counts = Posts::select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get();

        return view('site.user.index', compact('users', 'search', 'counts', 'routeName'));
    }

    public function show($id)
    {
        $routeName = Route::currentRouteName();
        
        $users = User::findOrFail($id);
        $posts = Posts::all();
        $comments = Comments::all();
        
        return view('site.user.show', compact('posts', 'users', 'comments', 'routeName'));
    }
}
