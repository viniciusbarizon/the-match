@if (isset($email))
    <div>
        <div class="mb-2">
            <x-input-label for="{{ $input }}" id="{{ $input }}_label" :value="__('Código')" />

            <x-text-input autocomplete="off" class="mt-1 w-full" id="{{ $input }}" maxlength="{{ $max_length }}"
                name="{{ $input }}" type="text" :value="old($input)" wire:model.defer="{{ $input }}" />

            <x-input-error class="mt-2" :messages="$errors->get($input)" />
        </div>

        <div>
            @if (session()->has('alert_type'))
                <x-alert type="{{ session('alert_type') }}" :message="__(session('alert_message'))" />
            @endif

            <x-white-button id="verify_code" wire:click="verify">
                {{ __('Verificar código') }}
            </x-white-button>
        </div>
    </div>
@endif
