<div class="space-y-4">
    <div>
        <x-input-label for="{{ $inputName }}" :value="__('Nome')" />

        <x-text-input autocomplete="{{ $inputName }}" class="mt-1 w-full" dusk="{{ $inputName }}" maxlength="255"
            name="{{ $inputName }}" type="text" :value="old($inputName)" wire:model.delay="{{ $inputName }}" required />
    </div>

    <div>
        <x-input-label for="{{ $inputSlug }}" :value="__('URL')" />

        <div class="h-5 text-sm">
            https://thematch.dev/with/
        </div>

        <x-text-input class="w-full" dusk="{{ $inputSlug }}" maxlength="255" name="{{ $inputSlug }}" type="text"
            :value="old($inputSlug)" wire:model.defer="{{ $inputSlug }}" required/>
    </div>
</div>
