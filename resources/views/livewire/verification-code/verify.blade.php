
    <div>
        <div class="mb-2">
            <x-input-label for="code" id="code_label" :value="__('Código')" />

            <x-text-input autocomplete="off" class="mt-1 w-full" disabled="{{ $disabled }}" id="code" maxlength="6"
                type="text" :value="old('code')" wire:model.defer="code" />

            <x-input-error class="mt-2" :messages="$errors->get('code')" />
        </div>

        <div>
            @if (session()->has('alert_type'))
                <x-alert type="{{ session('alert_type') }}" :message="__(session('alert_message'))" />
            @endif

            <x-white-button disabled="{{ $disabled }}" id="verify_code" wire:click="verify">
                {{ __('Verificar código') }}
            </x-white-button>
        </div>
    </div>

