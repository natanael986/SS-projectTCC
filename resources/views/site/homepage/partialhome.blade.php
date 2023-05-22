<?php
// define o idioma da formatação -->
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
// formata a data e hora por extenso -->
$date_time_extenso = strftime('%d/%b/%y', $post->created_at->getTimestamp());

// imprime a data e hora por extenso -->

?>

<?php
// define o idioma da formatação -->
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
// formata a data e hora por extenso -->
$date_time_extenso_post_created = strftime('%d/%b/%y,', $post->created_at->getTimestamp());

// imprime a data e hora por extenso -->

?>
<?php
// define o idioma da formatação -->
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
// formata a data e hora por extenso -->
$date_time_extenso_post_updated = strftime('%d/%b/%y,', $post->updated_at->getTimestamp());

// imprime a data e hora por extenso -->

?>
<div class="Home_publi">
    <div class="Home_publi_content">
        <h1>{{ $post->tittle }}</h1>

        <p>{{ $post->publication }}
        </p>
        <h2>Exemplo</h2>
        <i>{{ $post->context }}</i>
        <p><b>Por: </b>{{ $post->name }},
            @if ($post->created_at == $post->updated_at)
                <?php echo $date_time_extenso_post_created; ?>
            @else
                <?php echo $date_time_extenso_post_updated; ?>
                <a style="border: 2px solid; border-radius: 5px; padding: 1.5px"> editado </a>
            @endif
        </p>
        <div class="Home_publi_button">
            <div class="div_like">
                <div class="likeDislike">
                    @auth
                        @include('site.homepage.partialaction')
                    @endauth

                    {{-- <div class="overlay hidden"></div>
                    <button class="btn btn-open"><i class='bx bx-flag'></i></button> --}}
                    @auth
                        @if ($post->user_id != Auth::user()->id)
                            <div class="button-like">
                                <a class="btn btn-info" href="{{ route('Denúnciar Publicação', $post->id) }}">
                                    <i class='bx bx-flag'></i>
                                </a>
                            </div>
                        @endif
                        @if ($post->user_id == Auth::user()->id)
                            <div class="button-like">
                                <a type="button" href="{{ route('Editar Publicação', $post->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                            </div>
                            <form action="{{ route('postmanager.destroy', $post->id) }}" method="POST">
                                <div>

                                    <div class="button-like">
                                        @csrf
                                        @method('DELETE')
                                        <button style="border: none;">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

        </div>
    </div>
    <!-- <input type="checkbox" id="toggle-1"> -->

    <div id="parte{{ $post->id }}" class="parte ComentarioArea">
        <form id="comment-form" enctype="multipart/form-data">
            @csrf
            <div class="form_comment">
                <form>
                    <label class="label_comment" for="comment">Deixe seu comentário:</label>
                    <textarea class="textarea_comment" id="comment" name="comment" rows="5" maxlength="255"></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button class="button_comment" type="submit">Enviar</button>
                </form>
                <div id="comments-container">
                    <section id="comments">
                        @include('site.homepage.partialcomment')
                    </section>
                </div>

            </div>
        </form>
    </div>

    <section class="modal hidden">
        @include('site.Modals.modalDenuncia')
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(function() {
            $('#comment-form').on('submit', function(event) {
                event.preventDefault(); // prevent the form from submitting normally

                $.ajax({
                    url: '{{ route('commentmanager.store') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#comment-' + commentId);
                        LoadData();
                    }
                });

            });
            function LoadData({
                
            })
        });


        const modal = document.querySelector(".modal");
        const overlay = document.querySelector(".overlay");
        const openModalBtn = document.querySelector(".btn-open");
        const closeModalBtn = document.querySelector(".btn-close");

        // close modal function
        const closeModal = function() {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
        };

        // close the modal when the close button and overlay is clicked
        closeModalBtn.addEventListener("click", closeModal);
        overlay.addEventListener("click", closeModal);

        // close modal when the Esc key is pressed
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && !modal.classList.contains("hidden")) {
                closeModal();
            }
        });

        // open modal function
        const openModal = function() {
            modal.classList.remove("hidden");
            overlay.classList.remove("hidden");
        };
        // open modal event
        openModalBtn.addEventListener("click", openModal);
    </script>
