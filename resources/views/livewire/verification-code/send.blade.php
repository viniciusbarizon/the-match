<div class="mb-2">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input autocomplete="username" class="block mt-1 w-full" id="email" name="email" type="email"
        :value="old('email')" required/>
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div>
    <x-secondary-button x-on:click="$dispatch('close')">
        {{ __('Enviar código de verificação') }}
    </x-secondary-button>
</div>
