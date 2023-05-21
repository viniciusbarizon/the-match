<form wire:submit.prevent="submit">
    <div class="mb-2">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input autocomplete="username" class="block mt-1 w-full" id="email" name="email" type="email"
            :value="old('email')" wire:model="email" required/>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-guest.white-button type='submit'>
            {{ __('Enviar código de verificação') }}
        </x-guest.white-button>
    </div>
</form>
