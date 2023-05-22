<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Comentários</h2>
@foreach ($comments as $comment)
    <?php
    // define o idioma da formatação -->
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    // formata a data e hora por extenso -->
    $date_time_extenso_comment_created = strftime('%d/%b/%y,  %H:%M', $comment->created_at->getTimestamp());
    
    // imprime a data e hora por extenso -->
    
    ?>
    <?php
    // define o idioma da formatação -->
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    // formata a data e hora por extenso -->
    $date_time_extenso_comment_updated = strftime('%d/%b/%y,  %H:%M', $comment->updated_at->getTimestamp());
    
    // imprime a data e hora por extenso -->
    
    ?>



    @if ($comment->post_id == $post->id)
        @foreach ($users as $user)
            @if ($comment->user_id == $user->id)
                <ul>
                    <li>
                        <div>
                            <div class="comment_user_content">
                                <div id="comment{{ $comment->id }}" class="comment_user_content_item">
                                    <div>
                                        <img class="IconUsers"
                                            src="@if ($user->imagem == null) {{ asset('images/icon_user.svg') }} @else {{ $user->image }} @endif"
                                            alt="">
                                    </div>
                                    <div>
                                        <div>
                                            <b>
                                                {{ $comment->comment }}
                                            </b>
                                        </div>
                                        <script>
                                            const likeButtons = document.querySelectorAll('.like-button');
                                            const unlikeButtons = document.querySelectorAll('.unlike');
                                        </script>

                                    </div>
                                </div>
                                @auth
                                    <form action="{{ route('commentmanager.destroy', $comment->id) }}" method="POST">
                                        <div class="div_like">
                                            <div class="likeDislike">
                                                @can('update', $comment)
                                                @endcan

                                                @if ($comment->user_id == Auth::user()->id)
                                                    <div class="button-like">
                                                        <a type="button"
                                                            href="{{ route('commentmanager.edit', $comment->id) }}">
                                                            <i class='bx bx-edit-alt'></i>
                                                        </a>
                                                    </div>
                                                @endif

                                                @can('destroy', $comment)
                                                @endcan
                                                @if ($comment->user_id == Auth::user()->id)
                                                    <div class="button-like">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a type="submit">
                                                            <i class='bx bx-trash'></i>
                                                        </a>
                                                    </div>
                                                @endif

                                                @can('flag', $comment)
                                                @endcan
                                                @if ($comment->user_id != Auth::user()->id)
                                                    <div class="button-like">
                                                        <a type="button"
                                                            href="{{ route('commentreportmanager.create', $comment->id) }}">
                                                            <i class='bx bx-flag'></i>
                                                        </a>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                    </form>
                                @endauth
                            </div>
                            <div class="item_comment">
                                <p>{{ $comment->name }},

                                    @if ($comment->created_at == $comment->updated_at)
                                        <?php echo $date_time_extenso_comment_created; ?>
                                    @else
                                        <?php echo $date_time_extenso_comment_updated; ?>
                                        <a style="border: 2px solid; border-radius: 5px; padding: 1.5px"> editado </a>
                                </p>
                            </div>
            @endif

            <div class="likeDislike_comment">
                <div class="button-like">
                    <button type="submit" class="btn btn-primary" id="likes-comment-button-{{ $comment->id }}"
                        onclick="likeComment({{ $comment->id }}, 'liked')">
                        <i class="bx bx-like"></i>
                    </button>
                    <p style="color: black;" id="likes-comment-count-{{ $comment->id }}">
                        {{ $comment->likes()->where('status', 'liked')->count() }}</p>
                </div>
                <div class="button-like">
                    <button class="btn btn-primary" id="dislikes-comment-button-{{ $comment->id }}"
                        onclick="dislikeComment({{ $comment->id }}, 'liked')">
                        <i class="bx bx-dislike"></i>
                    </button>
                    <p style="color: black;" id="dislikes-comment-count-{{ $comment->id }}">
                        {{ $comment->likes()->where('status', 'disliked')->count() }}</p>
                </div>
            </div>
            </div>
            </li>
            </ul>
        @endif
    @endforeach
@endif
@endforeach


<script>
    // Like comment handler
    function likeComment(commentId, status) {
        $.ajax({
            url: '/comments/' + commentId + '/like',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(response) {
                // Update the UI with the new like and dislike counts
                $('#likes-comment-count-' + commentId).text(response.likesCount);
                $('#dislikes-comment-count-' + commentId).text(response.dislikesCount);

                // Update the UI with the current user status
                var CommentLikeIcon = $('#likes-comment-button-' + commentId).find('i');
                CommentLikeIcon.removeClass('bx-like');
                CommentLikeIcon.removeClass('bxs-like');
                if (response.userStatus == 'liked') {
                    CommentLikeIcon.addClass('bxs-like');
                } else {
                    CommentLikeIcon.addClass('bx-like');
                }
                // Reset the dislike button icon
                var CommentDislikeIcon = $('#dislikes-comment-button-' + commentId).find('i');
                CommentDislikeIcon.removeClass('bxs-dislike');
                CommentDislikeIcon.addClass('bx-dislike');
            }
        });
    }

    // Dislike comment handler
    function dislikeComment(commentId, status) {
        $.ajax({
            url: '/comments/' + commentId + '/dislike',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                status: status
            },
            success: function(response) {
                // Update the UI with the new like and dislike counts
                $('#likes-comment-count-' + commentId).text(response.likesCount);
                $('#dislikes-comment-count-' + commentId).text(response.dislikesCount);

                // Update the UI with the current user status
                var CommentDislikeIcon = $('#dislikes-comment-button-' + commentId).find('i');
                CommentDislikeIcon.removeClass('bx-dislike');
                CommentDislikeIcon.removeClass('bxs-dislike');
                if (response.userStatus == 'disliked') {
                    CommentDislikeIcon.addClass('bxs-dislike');
                } else {
                    CommentDislikeIcon.addClass('bx-dislike');
                }

                // Reset the like button icon
                var CommentLikeIcon = $('#likes-comment-button-' + commentId).find('i');
                CommentLikeIcon.removeClass('bxs-like');
                CommentLikeIcon.addClass('bx-like');
            }
        });
    }
</script>
