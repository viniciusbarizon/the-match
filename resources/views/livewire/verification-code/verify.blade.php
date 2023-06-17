
    <div>
        <div class="mb-2">
            <x-input-label for="verification_code" id="verification_code_label" :value="__('Código')" />

            <x-text-input autocomplete="off" class="mt-1 w-full" id="verification_code" maxlength="6"
                name="verification_code" type="text" :value="old('verification_code')"
                wire:model.defer="verificationCode" />

            <x-input-error class="mt-2" :messages="$errors->get('verificationCode')" />
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

