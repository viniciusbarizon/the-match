<div>
    <div class="mb-2">
        <x-input-label for="email" id="email_label" :value="__('E-mail')" />

        <x-text-input autocomplete="email" class="mt-1 w-full" readonly="{{ $disabled }}" id="email" maxlength="255"
            name="email" type="email" wire:model.defer="email" required />

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        @if (session()->has('alert_message'))
            <x-alert type="success" :message="__(session('alert_message'))" />
        @endif

        <x-white-button disabled="{{ $disabled }}" id="send_code" wire:click="send">
            {{ __('Enviar código de verificação') }}
        </x-white-button>
    </div>
</div>
