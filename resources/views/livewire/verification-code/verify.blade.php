<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Código')" />

        <x-text-input class="block mt-1 w-full" dusk="{{ $input }}" maxlength="6" minlength="6" name="{{ $input }}"
            type="text" :value="old('{{ $input }}')" wire:model.defer="verificationCode" required />

        <x-input-error :messages="$errors->get('{{ $input }}')" class="mt-2" />
    </div>

    <div class="mb-4">
        @if (session()->has($sessionVerified))
            <x-alert-success :message="session($sessionVerified)" />
        @endif

        <x-white-button dusk="{{ $submit }}" name="{{ $submit }}" type="submit">
            {{ __('Verificar código') }}
        </x-white-button>
    </div>
</form>
