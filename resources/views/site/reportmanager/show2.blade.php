@extends('layouts.layout')

@section('content')

<div class="Home_section">
    <div class="Home_header">
        <h4 class="mb-4">Publicação feita por: {{Auth::user()->name_id}}</h4>
    </div>

    <title>Área de Comentários</title>

    <div class="Home_publi">
        <div class="Home_publi_content">

            <h1>{{$comment_reports->reason}}</h1>
            <h1>{{$comment_reports->name}}</h1>
        </div>

    </div>
</div>
@endsection