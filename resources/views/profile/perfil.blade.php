@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_header">
            <h2 class="">PERFIL</h2>
        </div>

        <div class="card-photo card-photo-img">
            <div class="card-border-top">
                <span> ALTERAR FOTO</span>
            </div>
            <div class="img">
                @include('profile.partials.update-profile-imagem-information-form')
            </div>
        </div>
        <br><br>

        <div class="card-photo">
            <div class="card-border-top">

                <span> ALTERAR DADOS</span>
            </div>
            <span style="padding:30px;">@include('profile.partials.update-profile-information-form')</span>
        </div>
        <br><br>

        <div class="card-photo">
            <div class="card-border-top">
                <span> ALTERAR SENHA</span>
            </div>
            <span style="padding:30px;">@include('profile.partials.update-password-form')</span>
        </div>
        <br><br>

        <div class="card-photo">
            <div class="card-border-top">
                <span>EXCLUIR CONTA</span>
            </div>
            <span style="padding:30px;">@include('profile.partials.delete-user-form')</span>
        </div>
        <br><br>
    </div>
@endsection
