@extends('layouts.layout')

@section('content')
    @if (count($posts) == 0)
        <div class="Home_section">
            <div class="Home_header">
                <h2 class="mb-4">VOCÊ NÃO POSSUI PUBLICAÇÕES</h2>
                <a href="/post">CLIQUE AQUI PARA REALIZAR UMA PUBLICAÇÃO</a>
            </div>
        </div>
    @endif


    @if (count($posts) == 1)
        <div class="Home_section">
            <div class="Home_header">
                <h2 class="mb-4">MINHA PUBLICAÇÃO</h2>
            </div>
        </div>
    @endif

    @if (count($posts) > 1)
        <div class="Home_section">
            <div class="Home_header">
                <h2 class="mb-4">MINHAS PUBLICAÇÕES</h2>
            </div>
        </div>
    @endif

    @foreach ($posts as $post)
        @if ($post->user_id == Auth::user()->id)
            @if ($post->appropriate == 'yes')
                <div class="Home_section">
                    @include('site.homepage.partialhome')
                @else
                    @if ($post->appropriate == 'no')
                        @if (2023 - Auth::user()->ano_nascimento >= 18)
                            @include('site.homepage.partialhome')
                        @endif
                    @endif
            @endif
            </div>
        @endif
        <br />
        <br />
        <br />
    @endforeach
@endsection
