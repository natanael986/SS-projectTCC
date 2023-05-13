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
                                <div class="comment_user_content_item">
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
                <div class="form_like">
                    <form action="{{ route('comments.like', $comment) }}" method="post">
                        @csrf
                        <div class="button-like">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-like'></i>
                            </button>
                            <p>{{ $comment->likesCount() }}</p>
                        </div>
                    </form>
                </div>


                <div class="form_like">
                    <form action="{{ route('comments.dislike', $comment) }}" method="post">
                        @csrf

                        <div class="button-like">
                            <button type="submit">
                                <i class='bx bx-dislike'></i>
                            </button>
                            <p>{{ $comment->dislikesCount() }}</p>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </li>
            </ul>
        @endif
    @endforeach
@endif
@endforeach
