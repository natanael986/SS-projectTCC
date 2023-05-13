@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_header">
            <h4 class="mb-4">Denúncia feita por: {{ $post_reports->name }}</h4>
        </div>

        <title>Área de Comentários</title>

        <div class="Home_publi">
            <div class="Home_publi_content">

                <h1>{{ $post_reports->reason }}</h1>
                <h1>{{ $post_reports->name }}</h1>
                <h1>
                    <form method="get" action="{{ route('site.search') }}">
                        <a><button name="searchID" value="{{ $post_reports->post_id }}">Ir para a publicação</button></a>
                    </form>
                </h1>

            </div>

        </div>
    </div>
@endsection
