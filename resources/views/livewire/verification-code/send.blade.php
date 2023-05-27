<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Email')" />

        <x-text-input autocomplete="username" class="block mt-1 w-full" dusk="{{ $input }}"
            name="{{ $input }}" type="email" :value="old($input)" wire:model.defer="{{ $input }}" required/>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has($sessionAlert))
            <x-alert type="success" :message="session($sessionAlert)" />
        @endif

        <x-white-button dusk="{{ $duskButton }}" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
