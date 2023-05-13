<form action="{{ route('posts.like', $post) }}" method="post">
    @csrf
    <div class="button-like">
        <button type="submit" class="btn btn-primary">
            <i class='bx bx-like'></i>
        </button>
        <p style="color: black;">{{ $post->likesCount() }}</p>
    </div>
</form>
<form action="{{ route('posts.dislike', $post) }}" method="post">
    @csrf

    <div class="button-like">
        <button type="submit">
            <i class='bx bx-dislike'></i>
        </button>
        <p style="color: black;">{{ $post->dislikesCount() }}</p>
    </div>
</form>

<div class="button-like">
    <button id="commentButton" style="border: none;" type="button" class="btn-open"
        data-target="parte{{ $post->id }}">
        <i class='bx bx-message-square-dots'></i>
    </button>
</div>
