<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/logo_v2.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Street Slang - {{ $routeName }}
    </title>

</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <img src="{{ asset('images/logo_v2.svg') }}" alt="">
            <span class="logo_name">Stret Slang</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('Inicio') }}">
                    <i class='bx bx-home-alt-2'></i>
                    <span class="link_name">INICIO</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">INICIO</a></li>
                </ul>
            </li>
            <li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('Publicar') }}">
                            <i class='bx bx-book-add'></i>
                            <span class="link_name">ADICIONAR</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class='bx bx-book-add'></i>
                            <span class="link_name">ADICIONAR</span>
                        </a>
                    @endauth
                @endif
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">ADICIONAR</a></li>
                </ul>
            </li>
            <li>
                
                <div class="iocn-link">
                    <a>
                        <i class='bx bx-search'></i>
                        <span class="link_name"> PRIMEIRA LETRA </span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>

                @include('layouts.menu_letra')

            </li>
            <li>
                <a href="#">
                    <i class='bx bx-buildings'></i>
                    <span class="link_name">SOBRE</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">SOBRE</a></li>
                </ul>
            </li>
            @auth
                <li>
                    <div class="iocn-link">
                        <a href="{{ route('Minhas Publicações') }}">
                            <i class='bx bx-book-alt'></i>
                            <span class="link_name">MINHAS PUBLICAÇÔES</span>
                        </a>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">MINHAS PUBLICAÇÔES</a></li>
                    </ul>
                </li>
                @can('admin')
                    <li>
                        <div class="iocn-link">
                            <a>
                                <i class='bx bx-line-chart'></i>
                                <span class="link_name">ÁREA ADMINISTRATIVA</span>
                            </a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li><a class="link_name" href="#">ÁREA ADMINISTRATIVA</a></li>
                            <li><a href="{{ route('Denúncias') }}">DENÚNCIAS</a></li>
                            <li><a href="{{ route('Relatórios') }}">RELATÓRIOS</a></li>
                        </ul>
                    </li>
                @endcan
            @endauth

            <li>
                <div class="profile-details">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('Perfil', Auth::user()->id) }}">
                                <div class="profile-content">

                                    <img class="img user_icon_photo mb-4"
                                        src="@if (Auth::user()->image == null) {{ asset('images/icon_user.svg') }} @else @auth{{ Auth::user()->image }} @endauth @endif " />

                                </div>
                                <div class="name-job">
                                    <div class="profile_name">@auth{{ Auth::user()->name }}@endauth
                                    </div>
                                    <div class="job">Web Desginer</div>
                                </div>
                            </a>
                        @else
                            <a class="dropdown-item text-dark" href="{{ route('login') }}">
                                <div class="profile-content">

                                    <img src="{{ asset('images/icon_user.svg') }}" alt="">

                                </div>
                                <div class="name-job">
                                    <div class="profile_name">Acessar conta</div>
                                </div>
                            </a>
                        @endauth
                    @endif
                    @auth
                        @if (Route::has('login'))
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                                    title="Sair">
                                    <i class='bx bx-log-out'></i>
                                </a>
                            </form>
                        @endif
                    @endauth

                </div>

            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="header_content">
            <i class="bx bx-menu"></i>
            <div class="home-content">
                <div class="home-nav-left">
                    <div class="home-nav-left-itens">
                        <form method="get" action="{{ route('Inicio') }}">
                            <a class="button-random">
                                <button name="searchRandom">
                                    <i class='bx bx-shuffle'></i> <!-- Pesquisa ALeatória -->
                                </button>
                            </a>
                        </form>
                        <form action="{{ route('Pesquisa') }}" method="GET">
                            <div>
                                <a class="search-icon" href="#" type="submit">
                                    <i class='bx bx-search'></i>
                                </a>
                                <div class="list-search">
                                    <div class="input-wrapper">
                                        <input class="home-section-input" id="search" type="text"
                                            placeholder="Pesquisar" name="search" />
                                        <span class="clear-icon"><i class='bx bx-x'></i></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
                    <script type="text/javascript">
                        var route = "{{ url('autocomplete-search') }}";
                        $('#search').typeahead({
                            source: function(query, process) {
                                return $.get(route, {
                                    query: query
                                }, function(data) {
                                    // map the data to an array of titles
                                    var tittles = $.map(data, function(post) {
                                        return post.tittle;
                                    });
                                    return process(tittles);
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="divider">
            <hr class="divider-line" />
        </div>
        <!-- BODY PAGE CONTENT START -->
        @yield('content')
        <!-- BODY PAGE CONTENT END -->
    </section>
    <script src="{{ asset('js/ModalDenuncia.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/cadastro.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/AlterarImagem.js') }}"></script>
    <script src="{{ asset('js/validarCampos.js') }}"></script>
    <script src="{{ asset('js/comentario.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; // selecionando o pai principal da seta
                arrowParent.classList.toggle("showMenu");

                // Salvando a opção do usuário no sessionStorage
                sessionStorage.setItem("menuOpen", arrowParent.classList.contains("showMenu"));
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");

        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");

            // Salvando a opção do usuário no sessionStorage
            sessionStorage.setItem("sidebarClosed", sidebar.classList.contains("close"));
        });

        // Restaurando as opções do usuário do sessionStorage ao carregar a página
        window.addEventListener("DOMContentLoaded", () => {
            let menuOpen = sessionStorage.getItem("menuOpen");
            if (menuOpen) {
                let arrowParent = document.querySelector(".arrow").parentElement.parentElement;
                arrowParent.classList.toggle("showMenu", menuOpen === "true");
            }

            let sidebarClosed = sessionStorage.getItem("sidebarClosed");
            if (sidebarClosed) {
                sidebar.classList.toggle("close", sidebarClosed === "true");
            }
        });

        //LIMPA O CAMPO DE BUSCA
        const inputField = document.getElementById('search');
        const clearIcon = document.querySelector('.clear-icon');

        inputField.addEventListener('input', function() {
            clearIcon.style.display = this.value ? 'block' : 'none';
        });

        clearIcon.addEventListener('click', function() {
            inputField.value = '';
            clearIcon.style.display = 'none';
        });

        // let arrow = document.querySelectorAll(".arrow");
        // for (var i = 0; i < arrow.length; i++) {
        //     arrow[i].addEventListener("click", (e) => {
        //         let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        //         arrowParent.classList.toggle("showMenu");
        //     });
        // }
        // let sidebar = document.querySelector(".sidebar");
        // let sidebarBtn = document.querySelector(".bx-menu");
        // console.log(sidebarBtn);
        // sidebarBtn.addEventListener("click", () => {
        //     sidebar.classList.toggle("close");
        // });
    </script>
</body>

</html>
