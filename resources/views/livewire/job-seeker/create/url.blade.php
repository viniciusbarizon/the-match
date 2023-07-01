<div class="mb-4 space-y-4">
    <div>
        <x-input-label for="name" id="name_label" :value="__('Nome')" />

        <x-text-input autocomplete="name" class="mt-1 w-full" id="name" maxlength="255" name="name" type="text"
            wire:model.delay="name" required />

        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="slug" id="slug_label" :value="__('Slug')" />

        <x-text-input class="lowercase mt-1 w-full" id="slug" maxlength="255" name="slug" type="text" wire:model.delay="slug" required />

        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="url" id="url_label" :value="__('URL')" />

        <x-text-input class="lowercase mt-1 w-full" id="url" name="url" type="text" wire:model.delay="url" readonly required />

        <x-input-error :messages="$errors->get('url')" class="mt-2" />
    </div>
</div>
