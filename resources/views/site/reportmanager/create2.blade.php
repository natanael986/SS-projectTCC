@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_publi">
            <div id="" class="ComentarioArea">
                <form method="POST" action="{{ route('commentreportmanager.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form_comment">
                        <form>
                            <label class="label_comment" for="comment">Informe o motivo da denúncia:</label>
                            <textarea class="textarea_comment" id="comment" name="reason" rows="5" maxlength="255"></textarea>
                            <input type="hidden" name="comment_id" value="{{ $comments->id }}">
                            <input type="hidden" name="user_id" value="{{ $comments->user_id }}">
                            <button class="button_comment" type="submit">Enviar</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
