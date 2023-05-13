@extends('layouts.layout')

@section('content')
    @if (isset($searchType) && !empty(array_filter($searchType)))
        @foreach ($searchType as $key => $value)
            @if ($value)
                <div class="Home_section">
                    <div class="Home_header">
                        @if ($key === 'search')
                            @if ($posts->isEmpty())
                                <h2 class="mb-4">NÃO FOI POSSÍVEL ENCONTRAR: "{{ $value }}"</h2>
                            @else
                                <h2 class="mb-4">RESULTADO DE: "{{ $value }}"</h2>
                            @endif
                        @elseif ($key === 'searchID')
                            @if ($posts->isEmpty())
                                <h2 class="mb-4">NÃO FOI POSSÍVEL ENCONTRAR A PUBLICAÇÃO DE ORIGEM</h2>
                            @else
                                <h2 class="mb-4">PUBLICAÇÃO DE ORIGEM</h2>
                            @endif
                        @elseif ($key === 'searchFirst')
                            @if ($posts->isEmpty())
                                <h2 class="mb-4">NÃO FOI POSSÍVEL ENCONTRAR PALAVRAS COM A LETRA: "{{ $value }}"
                                </h2>
                            @else
                                <h2 class="mb-4">LETRA PESQUISADA: "{{ $value }}"</h2>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="Home_section">
            <div class="Home_header">
                <h2 class="mb-4">Teste</h2>
            </div>
        </div>
    @endif

    @if (isset($posts))
        @foreach ($posts as $post)
            @if ($post->appropriate === 'yes' || ($post->appropriate === 'no' && 2023 - Auth::user()->ano_nascimento >= 18))
                <div class="Home_section">
                    <div class="Home_section_publi">
                        @include('site.homepage.partialhome')
                    </div>
                </div>
            @endif
        @endforeach
    @endif



    <style>
        .parte {
            display: none;
        }

        .parte.active {
            display: block;
        }
    </style>
    <script>
        const btnsOpen = document.querySelectorAll('.btn-open');
        const partes = document.querySelectorAll('.parte');

        btnsOpen.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = btn.dataset.target;
                const parte = document.querySelector(`#${target}`);
                parte.classList.toggle('active');
            });
        });

        const commentContainer = document.querySelector('.parte');

        // Verifica se a chave "PainelFixo" existe no sessionStorage
        if (sessionStorage.getItem("PainelFixo") == "true") {
            // Se existir, adiciona a classe "active" no container
            commentContainer.classList.add("active");
        }

        // Salva o estado do painel fixo no sessionStorage ao clicar no botão
        btnsOpen.forEach(function(btn) {
            btn.addEventListener('click', function() {
                sessionStorage.setItem("PainelFixo", commentContainer.classList.contains("active"));
            });
        });

        // Restaura o estado do painel fixo quando a página for carregada
        window.addEventListener('load', () => {
            if (sessionStorage.getItem("PainelFixo") == "true") {
                commentContainer.classList.add("active");
            }
        });
    </script>
@endsection
