@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_header">
        </div>
        @foreach ($posts as $post)
            @if ($post->user_id == $users->id)
                <div class="Home_section">
                    {{ $post->tittle }}
                </div>
            @endif
        @endforeach

        <!-- <h1>{{ $users->name }}'s Posts</h1> -->
        
    </div>
    </div>
@endsection
