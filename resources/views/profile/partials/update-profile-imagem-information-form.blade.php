<section style="padding-bottom: 30px;">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="img_icon_user">
            <div class="max-width">
                <div class="imageContainer">
                    <img src="@auth {{ Auth::user()->image }} @endauth" width="120px" height="120px"
                        alt="Selecione uma imagem" id="imgPhoto">
                </div>
            </div>
            <x-text-input style="color: #FFFFFF;" id="image" name="image" type="file"
                class="mt-1 block w-full x-text-input" required />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>
        <div class="d-flex align-items-center gap-4">
            <span></span>

            <x-primary-button>{{ __('SALVAR') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p style="color: #FFFFFF;" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm">{{ __('DADOS SALVOS.') }}</p>
            @endif
        </div>
    </form>
</section>
