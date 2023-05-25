<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="verification_code" :value="__('Código')" />

        <x-text-input class="block mt-1 w-full" dusk="{{ $verificationCodeName }}"
            name="{{ $verificationCodeName }}" type="text" :value="old('verification_code')"
            wire:model.lazy="verificationCode" required/>

        <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has('verification-code-verify-message'))
            <div class="bg-green-100 leading-normal mb-2 px-2 py-2 rounded-lg text-green-700" role="alert">
                {{ session('verification-code-verify-message') }}
            </div>
        @endif

        <x-white-button dusk="{{ $submitName }}" name="{{ $submitName }}" type="submit">
            {{ __('Verificar código') }}
        </x-white-button>
    </div>
</form>
