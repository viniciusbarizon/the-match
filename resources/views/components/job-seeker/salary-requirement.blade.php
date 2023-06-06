<div class="space-y-4">
    <div>
        <x-input-label dusk="{{ $inputContract }}_label" for="{{ $inputContract }}" :value="__('Contrato')" />

        <x-select class="mt-1 w-full" :name="$inputContract"  :options="$contracts" required />
    </div>

    <div>
        <x-input-label dusk="{{ $inputCurrency }}_label" for="{{ $inputCurrency }}" :value="__('Moeda')" />

        <x-select class="mt-1 w-full" :name="$inputCurrency"  :options="$currencies" required />
    </div>

    <div>
        <x-input-label dusk="{{ $inputAmount }}_label" for="{{ $inputAmount }}" :value="__('Pretensão salarial')" />

        <input class="mt-1 text-input-select w-full" min="1" type="number" required>
    </div>
</div>
