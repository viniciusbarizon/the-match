<div class="mb-4 space-y-4">
    <div>
        <x-input-label for="{{ $inputName }}" :value="__('Nome')" />

        <x-text-input autocomplete="name" class="mt-1 w-full" id="{{ $inputName }}" maxlength="{{ $maxlength }}"
            name="{{ $inputName }}" type="text" :value="old($inputName)" wire:model.delay="{{ $inputName }}"
            required />

        <x-input-error :messages="$errors->get($inputName)" class="mt-2" />
    </div>

    <div>
        <x-input-label for="{{ $inputSlug }}" :value="__('Slug')" />

        <x-text-input class="mt-1 w-full" id="{{ $inputSlug }}" maxlength="{{ $maxlength }}" name="{{ $inputSlug }}"
            type="text" :value="old($inputSlug)" wire:model.delay="{{ $inputSlug }}" required />

        <x-input-error :messages="$errors->get($inputSlug)" class="mt-2" />
    </div>

    <div>
        <x-input-label for="{{ $inputUrl }}" :value="__('URL')" />

        <x-text-input class="mt-1 w-full" id="{{ $inputUrl }}" name="{{ $inputUrl }}" type="text"
            wire:model.defer="{{ $inputUrl }}" readonly />
    </div>
</div>
