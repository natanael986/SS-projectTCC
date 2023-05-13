@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_publi">
            <div id="" class="ComentarioArea">
                <form method="POST" action="{{ route('Banir', $users->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form_comment">
                        <form>
                            <label class="label_comment" for="comment">Banir usuário por tempo inderteminado:
                                {{ $users->name }}</label>
                            <input type="hidden" name="post_id" value="{{ $users->id }}">
                            @if ($users->banned != true)
                                <button class="button_comment" type="submit">Banir</button>
                            @else
                                <button class="button_comment" type="submit">Desbanir</button>
                            @endif

                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
