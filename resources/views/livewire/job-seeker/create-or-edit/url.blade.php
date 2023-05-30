<div class="space-y-4">
    <div>
        <x-input-label for="name" :value="__('Nome')" />

        <x-text-input autocomplete="name" class="mt-1 w-full" dusk="name" maxlength="255" name="name" type="text"
            :value="old('name')" wire:model.defer="name" required/>
    </div>

    <div>
        <x-input-label for="name" :value="__('URL')" />

        <div class="h-5 text-sm">
            https://thematch.dev/with/
        </div>

        <x-text-input class="w-full" dusk="slug" maxlength="255" name="slug" type="text" :value="old('slug')"
            wire:model.defer="slug" required/>
    </div>
</div>
