@extends('layouts.layout')

@section('content')
<div class="Home_section">
    <div class="Home_publi">
        <div id="" class="ComentarioArea">
            <form method="POST" action="{{ route('commentmanager.update', $comments) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form_comment">
                    <form>
                        <label class="label_comment" for="comment">Deixei seu comentário: "{{$comments->comment }}"</label>
                        <textarea class="textarea_comment" id="comment" name="comment" rows="5" maxlength="255"></textarea>
                        <button class="button_comment" type="submit">Enviar</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection