@extends('layouts.layout')

@section('content')
    <form action="{{ route('site.user') }}" method="GET">
        <div class="list-search">
            <input class="home-section-input" id="search" type="text" placeholder="Pesquisar" name="search" />
        </div>
        <a class="search-icon" href="#" type="submit">
            <ion-icon style="font-size: 30px;" name="search-outline"></ion-icon>
        </a>
    </form>
    {{-- @if ($search) --}}
    <div class="container-card">
        @foreach ($users as $user)
            <?php
            $date = strftime('%d/%b/%y', $user->created_at->getTimestamp());
            ?>
            <?php
            $count = $counts->where('user_id', $user->id)->first();
            $postCount = $count ? $count->count : 0;
            ?>
            {{-- <div class="card">
                <img src="https://via.placeholder.com/150" alt="Imagem do Card">
                <h3>Título do Card</h3>
                <p>Descrição do Card.</p>
                <a href="#">Link do Card</a>
            </div> --}}


            <div class="wrapper">
                <div class="top-icons">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="far fa-heart"></i>
                </div>

                <form action="" method="GET">
                    <div class="profile">
                        <img src="{{ asset('$user->image') }}" class="thumbnail">
                        <div class="check"><i class="fas fa-check"></i></div>
                        <h3 class="name">{{ $user->name_id }}</h3>
                        <p class="title"><?php echo $date; ?></p>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Neque
                            aliquam
                            aliquid
                            porro!</p>
                        <a>
                            <button type="button" class="btn">VISUALIZAR PUBLICAÇÕES</button>
                        </a>

                    </div>
                </form>
                <div class="social-icons">
                    <div class="icon">
                        <a href="{{ route('user.show', $user->id) }}"><i class="fab fa-dribbble"></i>
                            {{ $postCount }}</a>
                        <h4>PUBLICAÇÕES</h4>
                        <p>Followers</p>
                    </div>

                    <div class="icon">
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <h4>EXCLUIR</h4>
                        <p>Followers</p>
                    </div>

                    <div class="icon">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <h4>12.8k</h4>
                        <p>Followers</p>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
    {{-- @endif --}}
@endsection
