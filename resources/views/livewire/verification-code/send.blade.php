<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Email')" />

        <x-text-input autocomplete="username" class="block mt-1 w-full" dusk="{{ $input }}"
            name="{{ $input }}" type="email" :value="old($input)" wire:model.defer="{{ $input }}" required/>

        <x-input-error :messages="$errors->get($input)" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has($session_alert))
            <x-alert type="success" :message="session($session_alert)" />
        @endif

        <x-white-button dusk="{{ $dusk_button }}" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
