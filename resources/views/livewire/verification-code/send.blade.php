<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" id="{{ $input }}_label" :value="__('E-mail')" />

        <x-text-input autocomplete="email" class="mt-1 w-full" id="{{ $input }}" name="{{ $input }}" type="email"
            :value="old($input)" wire:model.defer="{{ $input }}" required/>

        <x-input-error :messages="$errors->get($input)" class="mt-2" />
    </div>

    <div>
        @if (session()->has('info'))
            <x-alert type="info" :message="__('Este e-mail já está verificado.')" />
        @endif

        @if (session()->has('success'))
            <x-alert type="success" :message="__('Enviamos um código de verificação para o seu e-mail.')" />
        @endif

        <x-white-button id="send_code" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
