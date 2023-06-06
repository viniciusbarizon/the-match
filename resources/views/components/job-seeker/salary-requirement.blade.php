<div class="space-y-4">
    <div>
        <x-input-label dusk="{{ $inputContract }}_label" for="{{ $inputContract }}" :value="__('Contrato')" />

        <select class="mt-1 text-input-select w-full" dusk="{{ $inputContract }}" id="{{ $inputContract }}"
            name="{{ $inputContract }}" required
        >
            @foreach ($contracts as $id => $name)
                <option value="{{ $id }}">
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label dusk="{{ $inputCurrency }}_label" for="{{ $inputCurrency }}" :value="__('Moeda')" />

        <select class="mt-1 text-input-select w-full" dusk="{{ $inputCurrency }}" id="{{ $inputCurrency }}"
            name="{{ $inputCurrency }}" required
        >
            @foreach ($currencies as $id => $name)
                <option value="{{ $id }}">
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label dusk="{{ $inputAmount }}_label" for="{{ $inputAmount }}" :value="__('Pretensão salarial')" />

        <input class="mt-1 text-input-select w-full" min="1" type="number" required>
    </div>
</div>
