<section style="padding-bottom: 30px;" class="space-y-6">
    <div style="display: flex; justify-content: center; align-items: center">
        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('DELETAR CONTA') }}</x-danger-button>
    </div>

    <div>
        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div style="text-align: center;">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Você tem certeza que deseja deletar esta conta?') }}
                </h2>
                </div>
                

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Uma vez que deletada, Todos os seus dados serão deletados permanentemente. 
                    Por favor insira sua senha para deletar esta conta permanentemente.') }}
                </p>

                <div class="mt-6" style="color: #FFFFFF; display: flex; justify-content: center;">
                    <x-input-label for="password" value="Password" class="sr-only" />

                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="Senha" />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('CANCELAR') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('DELETAR CONTA') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>

</section>