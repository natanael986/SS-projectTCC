<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="button-like">
    <button type="submit" class="btn btn-primary" id="like-button-{{ $post->id }}"
        onclick="likePost({{ $post->id }}, 'liked')">
        <i class="bx bx-like"></i>
    </button>
    <p style="color: black;" id="likes-count-{{ $post->id }}">
        {{ $post->likes()->where('status', 'liked')->count() }}</p>
</div>

<div class="button-like">
    <button type="submit" class="btn btn-primary" id="dislike-button-{{ $post->id }}"
        onclick="dislikePost({{ $post->id }}, 'liked')">
        <i class="bx bx-dislike"></i>
    </button>
    <p style="color: black;" id="dislikes-count-{{ $post->id }}">
        {{ $post->likes()->where('status', 'disliked')->count() }}</p>
</div>


<div class="button-like">
    <button id="commentButton" style="border: none;" type="button" class="btn-open"
        data-target="parte{{ $post->id }}">
        <i class='bx bx-message-square-dots'></i>
    </button>
</div>

<script>
    // Like button handler
    function likePost(postId, status) {
        $.ajax({
            url: '/posts/' + postId + '/like',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(response) {
                // Update the UI with the new like and dislike counts
                $('#likes-count-' + postId).text(response.likesCount);
                $('#dislikes-count-' + postId).text(response.dislikesCount);

                // Update the UI with the current user status
                var likeIcon = $('#like-button-' + postId).find('i');
                likeIcon.removeClass('bx-like');
                likeIcon.removeClass('bxs-like');
                if (response.userStatus == 'liked') {
                    likeIcon.addClass('bxs-like');
                } else {
                    likeIcon.addClass('bx-like');
                }

                // Reset the dislike button icon
                var dislikeIcon = $('#dislike-button-' + postId).find('i');
                dislikeIcon.removeClass('bxs-dislike');
                dislikeIcon.addClass('bx-dislike');
            }
        });
    }

    // Dislike button handler
    function dislikePost(postId, status) {
        $.ajax({
            url: '/posts/' + postId + '/dislike',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(response) {
                // Update the UI with the new like and dislike counts
                $('#likes-count-' + postId).text(response.likesCount);
                $('#dislikes-count-' + postId).text(response.dislikesCount);

                // Update the UI with the current user status
                var dislikeIcon = $('#dislike-button-' + postId).find('i');
                dislikeIcon.removeClass('bx-dislike');
                dislikeIcon.removeClass('bxs-dislike');
                if (response.userStatus == 'disliked') {
                    dislikeIcon.addClass('bxs-dislike');
                } else {
                    dislikeIcon.addClass('bx-dislike');
                }

                // Reset the like button icon
                var likeIcon = $('#like-button-' + postId).find('i');
                likeIcon.removeClass('bxs-like');
                likeIcon.addClass('bx-like');
            }
        });
    }
</script>
