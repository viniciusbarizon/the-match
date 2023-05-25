<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="{{ $verificationCodeName }}" :value="__('Código')" />

        <x-text-input class="block mt-1 w-full" dusk="{{ $verificationCodeName }}" maxlength="6" minlength="6"
            name="{{ $verificationCodeName }}" type="text" :value="old('{{ $verificationCodeName }}')"
            wire:model.defer="verificationCode" required/>

        <x-input-error :messages="$errors->get('{{ $verificationCodeName }}')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has('verification-code-verify-message'))
            <x-alert-success :message="session('verification-code-verify-message')" />
        @endif

        <x-white-button dusk="{{ $submitName }}" name="{{ $submitName }}" type="submit">
            {{ __('Verificar código') }}
        </x-white-button>
    </div>
</form>
