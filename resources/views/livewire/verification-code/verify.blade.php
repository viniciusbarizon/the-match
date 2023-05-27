<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="{{ $input }}" :value="__('Código')" />

        <x-text-input class="block mt-1 w-full" dusk="{{ $input }}" maxlength="6" minlength="6" name="{{ $input }}"
            type="text" :value="old($input)" wire:model.defer="verificationCode" required />

        <x-input-error class="mt-2" :messages="$errors->get($input)" />
    </div>

    <div class="mb-4">
        @if (session()->has($sessionSuccessfullyVerified))
            @if (session($sessionSuccessfullyVerified) === true)
                <x-alert type="success" :message="__('O Código foi verificado!')" />
            @else
                <x-alert type="danger" :message="__('Código inválido, por favor tente novamente.')" />
            @endif
        @endif

        <x-white-button dusk="{{ $duskButton }}" wire:click="verify">
            {{ __('Verificar código') }}
        </x-white-button>
    </div>
</form>
