@extends('layouts.layout')

@section('content')

    <head>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    </head>


    <div class="form-style-5">
        <form method="POST" action="{{ route('postmanager.update', $posts) }}" enctype="multipart/form-data">
            @csrf
            <h3>Editar publicação</h3>
            <h3>Aqui é onde a mágica acontece, você pode atribuir uma definição a uma palavra de
                acordo com seu conhecimento<br>
                É importante que você leia as <a href="{{ route('site.about') }}">diretrizes</a>
                do nosso site antes de realizar a publicação</h3>

            <fieldset>
                <label>Palavra ou expressão</label>
                <input type="text" name="tittle" placeholder="GOAT" value="{{ $posts->tittle }}">

                <label>Escreva sua definição</label>
                <textarea type="text" maxlength="500" name="publication" placeholder="GOAT é um termo...">{{ $posts->publication }}</textarea>

                <label>Contexto que a palavra ou expressão se encaixa</label>
                <textarea name="context" maxlength="500" placeholder="Lionel Messi é o GOAT">{{ $posts->context }}</textarea>


                <p> Essa uma publicação apropriada para menores? </p>
                <br>

                <p>
                    <input type="radio" id="test1" name="appropriate" value="yes" checked>
                    <label for="test1">SIM</label>
                </p>
                <p>
                    <input type="radio" id="test2" name="appropriate" value="no">
                    <label for="test2">NÃO</label>
                </p>


            </fieldset>
            <br>
            <input type="submit" value="ENVIAR" />
        </form>
    </div>
@endsection
