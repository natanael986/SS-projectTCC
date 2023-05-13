<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Street Slang</title>
    <link rel="stylesheet" href="{{ asset('css/indexlayout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/publi.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/AlterarImagem.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/likeDislike.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/usercard.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" /> --}}


    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="" sizes="192x192" />
</head>

<body onselectstart="return false">
    <div class="sidebar close">
        <ul class="nav-links">
            <div>
                <!-- <a href="{{ route('profile.edit') }}">
                    <img class="img user_icon_photo mb-4" src="{{ asset('images/quavo.jpg') }}" />
                    <ion-icon class="img user_icon_photo mb-4" style="color: #FFFFFF;" name="person-circle-sharp"></ion-icon>
                </a> -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('profile.edit', Auth::user()->id) }}">
                            <img class="img user_icon_photo mb-4" src="@auth{{ Auth::user()->image }} @endauth" />
                        </a>
                    @else
                        <a class="dropdown-item text-dark" href="{{ route('login') }}">
                            <ion-icon class="img user_icon_photo mb-4" style="color: #FFFFFF;" name="person-circle-sharp">
                            </ion-icon>
                        </a>
                    @endauth
                @endif

            </div>
            <li class="nav-item">
                <a href="/" title="Inicio">
                    <i class="nav-item-icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </i>
                    <span class="link_name">INÍCIO</span>
                </a>
            </li>
            <li class="nav-item">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('postmanager.create') }}" title="Adicionar uma palavra">
                            <i class="nav-item-icon">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </i>
                            <span class="link_name">ADICIONAR</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" title="Adicionar uma palavra">
                            <i class="nav-item-icon">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </i>
                            <span class="link_name">ADICIONAR</span>
                        </a>
                    @endauth
                @endif
            </li>
            <li class="nav-item">
                <form method="get" action="{{ route('site.search') }}">
                    {{-- <a>
                        <button name="searchRandom">
                            <ion-icon name="shuffle-outline"></ion-icon>
                            <span class="link_name-menu">Aleatória</span>
                        </button>
                    </a> --}}
                </form>
                <div class="icon-link">
                    <a href="" title="Tipo de Pesquisa">
                        <i class="nav-item-icon">
                            <ion-icon name="search-circle-outline"></ion-icon>
                        </i>
                        <span class="link_name">PESQUISA / PRIMEIRA LETRA</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <form method="get" action="{{ route('site.search') }}">
                    <ul class="sub-menu blank">
                        <li>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="A">A</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="B">B</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="C">C</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="D">D</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="E">E</button></a>
                                </div>
                            </div>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="F">F</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="G">G</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="H">H</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="I">I</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="J">J</button></a>
                                </div>
                            </div>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="K">K</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="L">L</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="M">M</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="N">N</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="O">O</button></a>
                                </div>
                            </div>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="P">P</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="Q">Q</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="R">R</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="S">S</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="T">T</button></a>
                                </div>
                            </div>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="U">U</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="V">V</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="W">W</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="X">X</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="Y">Y</button></a>
                                </div>
                            </div>
                            <div class="LetraPesquisa">
                                <div class="LetraButton">
                                    <a><button name="searchFirst" value="Z">Z</button></a>
                                </div>
                                <div class="LetraButton">
                                    <a><button name="searchRandom">#</button></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
            </li>
            <li class="nav-item">
                <a href="" title="Sobre">
                    <i class="nav-item-icon">
                        <ion-icon name="business-outline"></ion-icon>
                    </i>
                    <span class="link_name">SOBRE</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('mypublimanager.index') }}" title="Minhas publicações">
                    <i class="nav-item-icon">
                        <ion-icon name="file-tray-stacked-outline"></ion-icon>
                    </i>
                    <span class="link_name">MINHAS PUBLICAÇÕES</span>
                </a>
            </li>
            <li class="nav-item">
                <div class="icon-link">
                    <a href="" title="Tipo de Pesquisa">
                        <i class="nav-item-icon">
                            <ion-icon name="cellular-outline"></ion-icon>
                        </i>
                        <span class="link_name">ÁREA ADMINISTRATIVA</span>
                    </a>
                    <i class="bx bxs-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <div class="icon-link">
                            <a href="{{ route('reportmanager.index') }}" title="Pesquisa aleatória">
                                <ion-icon name="shuffle-outline"></ion-icon>
                                <span class="link_name-menu">Denúncia</span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="icon-link">
                            <a href="{{ route('user.index') }}" title="Pesquisar pela primeira letra">
                                <ion-icon name="library-outline"></ion-icon>
                                <span class="link_name-menu">Relatórios</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="nav-item logout">
                @if (Route::has('login'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            title="Sair">
                            <i class="nav-item-icon">
                                <ion-icon name="power-outline"></ion-icon>
                            </i>
                            <span class="link_name" style="color: #6e768e">Sair</span>
                        </a>
                    </form>
                @endif
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="header_content">
            <i class="bx bx-menu"></i>
            <div class="home-content">
                <div class="home-nav-left">
                    <form method="get" action="{{ route('site.search') }}">
                        <a class="button-random">
                            <button name="searchRandom">
                                <ion-icon name="shuffle-outline"></ion-icon>
                                {{-- <span class="link_name-menu">Aleatória</span> --}}
                            </button>
                        </a>
                    </form>
                    <form action="{{ route('site.search') }}" method="GET">
                        <div class="list-search">
                            <input class="home-section-input" id="search" type="text" placeholder="Pesquisar"
                                name="search" />
                        </div>
                        <a class="search-icon" href="#" type="submit">
                            <ion-icon style="font-size: 30px;" name="search-outline"></ion-icon>
                        </a>
                    </form>

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

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }
        let arrowList = document.querySelectorAll(".subMenu");
        for (var i = 0; i < arrowList.length; i++) {
            arrowList[i].addEventListener("click", (e) => {
                let arrowListParent = e.target.parentElement.parentElement;
                arrowListParent.classList.toggle("showMenu-item");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        function searchSubmit() {
            document.getElementById("searchSubmit").submit();
        }

        function index() {
            window.location.href = "index.html";
        }
    </script>
</body>

</html>
