<div class="space-y-4">
    <div>
        <x-input-label for="{{ $inputName }}" :value="__('Nome')" />

        <x-text-input autocomplete="{{ $inputName }}" class="mt-1 w-full" dusk="{{ $inputName }}" maxlength="255"
            name="{{ $inputName }}" type="text" :value="old($inputName)" wire:model.defer="{{ $inputName }}" required />
    </div>

    <div>
        <x-input-label for="slug" :value="__('URL')" />

        <div class="h-5 text-sm">
            https://thematch.dev/with/
        </div>

        <x-text-input class="w-full" dusk="slug" maxlength="255" name="slug" type="text" :value="old('slug')"
            wire:model.defer="slug" required/>
    </div>
</div>
