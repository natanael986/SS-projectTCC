<section style="padding-bottom: 30px;">

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label style="color: #FFFFFF;" for="current_password" :value="__('SENHA ATUAL')" />
            <x-text-input style="color: #FFFFFF;" id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label style="color: #FFFFFF;" for="password" :value="__('NOVA SENHA')" />
            <x-text-input style="color: #FFFFFF;" id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label style="color: #FFFFFF;" for="password_confirmation" :value="__('CONFIRMAR SENHA')" />
            <x-text-input style="color: #FFFFFF;" id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('SALVAR') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p style="color: #FFFFFF;"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm"
                >{{ __('SENHA ALTERADA COM SUCESSO.') }}</p>
            @endif
        </div>
    </form>
</section>
