<div>
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Código')" />

        <x-text-input autocomplete="off" class="mt-1 w-full" dusk="{{ $input }}" id="{{ $input }}"
            maxlength="{{ $max_length }}" name="{{ $input }}" type="text" :value="old($input)"
            wire:model.defer="{{ $input }}" />

        <x-input-error class="mt-2" :messages="$errors->get($input)" />
    </div>

    <div class="mb-4">
        @if (session()->has($session_successfully_verified))
            @if (session($session_successfully_verified) === true)
                <x-alert type="success" :message="__('O Código foi verificado!')" />
            @else
                <x-alert type="danger" :message="__('Código inválido, por favor tente novamente.')" />
            @endif
        @endif

        <x-white-button dusk="verify_code" wire:click="verify">
            {{ __('Verificar código') }}
        </x-white-button>
    </div>
</div>
