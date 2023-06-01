<div class="space-y-4">
    <div>
        <x-input-label for="{{ $inputName }}" :value="__('Nome')" />

        <x-text-input autocomplete="name" class="mt-1 w-full" dusk="{{ $inputName }}" id="{{ $inputName }}"
            maxlength="255" name="{{ $inputName }}" type="text" :value="old($inputName)"
            wire:model.delay="{{ $inputName }}" required />
    </div>

    <div>
        <x-input-label for="{{ $inputSlug }}" :value="__('Slug')" />

        <x-text-input class="mt-1 w-full" dusk="{{ $inputSlug }}" id="{{ $inputSlug }}" maxlength="255"
            name="{{ $inputSlug }}" type="text" :value="old($inputSlug)" wire:model.delay="{{ $inputSlug }}"
            required />
    </div>

    <div>
        <x-input-label for="{{ $inputUrl }}" :value="__('URL')" />

        <x-text-input class="mt-1 w-full" dusk="{{ $inputUrl }}" id="{{ $inputUrl }}" name="{{ $inputUrl }}"
            type="text" wire:model.defer="{{ $inputUrl }}" readonly />
    </div>
</div>
