@extends('layouts.layout')

@section('content')
<div class="Home_section">
    <div class="Home_publi">
        <div id="" class="ComentarioArea">
            <form method="POST" action="{{ route('reportmanager.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form_comment">
                    <form>
                        <label class="label_comment" for="comment">Informe o motivo da denúncia:{{ $posts->name }}</label>
                        <textarea class="textarea_comment" id="comment" name="reason" rows="5" maxlength="255"></textarea>
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                        <input type="hidden" name="user_id" value="{{ $posts->user_id }}">
                        <button class="button_comment" type="submit">Enviar</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
