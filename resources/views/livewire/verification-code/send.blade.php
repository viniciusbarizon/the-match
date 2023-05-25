<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Email')" />

        <x-text-input autocomplete="username" class="block mt-1 w-full" dusk="{{ $input }}"
            name="{{ $input }}" type="email" :value="old($input)" wire:model.lazy="{{ $input }}" required/>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has($sessionAlert))
            <x-alert-success :message="session($sessionAlert)" />
        @endif

        <x-white-button dusk="{{ $submit }}" name="{{ $submit }}" type="submit">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</form>
