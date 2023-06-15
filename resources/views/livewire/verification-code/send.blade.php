<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" id="{{ $input }}_label" :value="__('E-mail')" />

        <x-text-input autocomplete="email" class="mt-1 w-full" id="{{ $input }}" name="{{ $input }}" type="email"
            :value="old($input)" wire:model.defer="{{ $input }}" required/>

        <x-input-error :messages="$errors->get($input)" class="mt-2" />
    </div>

    <div>
        @if (session()->has('alert_type'))
            <x-alert type="{{ session('alert_type') }}" :message="__(session('alert_message'))" />
        @endif

        <x-white-button id="send_code" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
