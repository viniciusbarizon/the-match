<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="email" :value="__('Email')" />

        <x-text-input autocomplete="username" class="block mt-1 w-full" dusk="{{ $emailName }}"
            name="{{ $emailName }}" type="email" :value="old('email')" wire:model.lazy="email" required/>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has('verification-code-send-message'))
            <x-alert-success :message="session('verification-code-send-message')" />
        @endif

        <x-white-button dusk="{{ $submitName }}" name="{{ $submitName }}" type="submit">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</form>
