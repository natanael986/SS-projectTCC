<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CommentsLikes;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\post;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retorna o nome da rota atual
        $routeName = Route::currentRouteName();

        // Componentes para a montagem dos posts
        $likes = CommentsLikes::all();
        $comments = Comments::all();
        $users = User::all();

        $searchType = [
            'search' => request('search'),
            'searchID' => request('searchID'),
            'searchFirst' => request('searchFirst')
        ];

        $searchMensage = null;
        $posts = null;

        if ($routeName === "Pesquisa") {
            if (!empty(array_filter($searchType))) {
                foreach ($searchType as $key => $value) {
                    if ($value) {
                        $posts = $this->getFilteredPosts($searchType);
                        $searchMensage = $this->getSearchMessage($key, $value, $posts);
                        break;
                    }
                }
            } else {
                $searchMensage = "INÍCIOTESTE";
                $posts = $this->getFilteredPosts($searchType);
            }
        } else {
            $posts = Posts::inRandomOrder()->get();
        }

        return view('site.home', compact('posts', 'comments', 'users', 'likes', 'routeName', 'searchType', 'searchMensage'));
    }

    private function getSearchMessage($key, $value, $posts)
    {
        switch ($key) {
            case 'search':
                return count($posts) === 0 ? "Não há nenhuma publicação para: {$value}" : "Publicações encontradas para: {$value}";
            case 'searchID':
                return count($posts) === 0 ? "Não foi encontrada a publicação de origem para: {$value}" : "Publicações de origem encontradas para: {$value}";
            case 'searchFirst':
                return count($posts) === 0 ? "Não foi encontrado nenhuma palavra com essa letra: {$value}" : (count($posts) === 1 ? "Publicação encontrada para a letra: {$value}" : "Publicações encontradas para a letra: {$value}");
            default:
                return null;
        }
    }

    private function getFilteredPosts($searchType)
    {
        if ($searchType['search']) {
            $search = $searchType['search'];
            return Posts::where('tittle', 'like', "%{$search}%")->get();
        } elseif ($searchType['searchID']) {
            return Posts::where('id', $searchType['searchID'])->get();
        } elseif ($searchType['searchFirst']) {
            $search = $searchType['searchFirst'];
            return Posts::where('tittle', 'LIKE', "{$search}%")->get();
        } else {
            return Posts::all();
        }
    }


    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');

        $posts = Posts::select('tittle')->where('tittle', 'LIKE', "$query%")->get();
        return response()->json($posts);
    }
}
