<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Email')" />

        <x-text-input autocomplete="username" class="block mt-1 w-full" dusk="{{ $input }}"
            name="{{ $input }}" type="email" :value="old($input)" wire:model.defer="{{ $input }}" required/>

        <x-input-error :messages="$errors->get($input)" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has($session_email_has_been_sent))
            <x-alert type="success" :message="__('Enviamos um código de verificação para o seu e-mail.')" />
        @endif

        <x-white-button dusk="send_code" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
