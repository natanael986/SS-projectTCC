@extends('layouts.layout')

@section('content')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="form_sing_in">
    <h2>Aqui você pode realizar seu Login ou seu Cadastro!</h2>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <span>Acesse a sua conta</span>
                <x-text-input id="email" type="text" placeholder="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                <x-text-input id="password" type="password" placeholder="Senha" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                @if (Route::has('password.request'))
                <a style="padding-top: 10px; padding-bottom: 10px;" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900
                dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2
                focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
                <a href="index.html"><button>Entrar</button></a>
                @endif
            </form>
        </div>
        <div class="form-container sign-up-container">
            <form id="myForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                @if (session('status'))
                <div class="mt-3 alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="mt-3 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h1>Crie sua conta</h1>

                <input id="name_id" placeholder="Nome de Usuário" type="text" name="name_id" required />
                @if($errors->has('name_id'))
                <span style="font-size: 16px;" class="error-message" id="username-error">
                    @if($errors->first('name_id'))
                    nome de usuário já está sendo utilizado
                    @endif
                </span>
                @endif

                <input id="name" placeholder="Nome" type="text" name="name" required />
                <span style="font-size: 16px;" class="error-message" id="name-error"></span>

                <input id="email" type="email" placeholder="E-mail" name="email" required />
                <span style="font-size: 16px;" class="error-message" id="email-error"></span>

                <input type="int" id="ano_nascimento" name="ano_nascimento" placeholder="Ano de Nascimento Ex:2000" maxlength="4" />

                <input id="password" type="password" placeholder="Senha" name="password" required autocomplete="new-password" />
                <span style="font-size: 16px;" class="error-message" id="password-error"></span>

                <input id="confirm-password" placeholder="Insira a Senha novamente" type="password" name="password_confirmation" required />
                <span style="font-size: 16px;" class="error-message" id="confirm-password-error"></span>

                <input type="hidden" id="image" name="image" value="{{ asset('images/user.png') }}" />

                <a><button>Cadastrar-se</button></a>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Para Entrar</h1>
                    <p>Pressione o botão abaixo para realizar o seu login</p>
                    <button class="ghost" id="signIn">Entrar</button>
                    <br></br>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá!</h1>
                    <p>Pressione o botão abaixo pra iniciar seu cadastro</p>
                    <button class="ghost" id="signUp">Cadastrar-se</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
