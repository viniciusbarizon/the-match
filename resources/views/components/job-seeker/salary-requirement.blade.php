<div class="space-y-4">
    <div>
        <x-input-label for="{{ $inputContract }}" id="{{ $inputContract }}_label" :value="__('Contrato')" />
        <x-select class="mt-1 w-full" :name="$inputContract" :options="$contracts" required />

        <x-input-error class="mt-2" :messages="$errors->get($inputContract)" />
    </div>

    <div>
        <x-input-label for="{{ $inputCurrency }}" id="{{ $inputCurrency }}_label" :value="__('Moeda')" />
        <x-select class="mt-1 w-full" :name="$inputCurrency" :options="$currencies" required />

        <x-input-error class="mt-2" :messages="$errors->get($inputCurrency)" />
    </div>

    <div>
        <x-input-label for="{{ $inputSalary }}" id="{{ $inputSalary }}_label" :value="__('Pretensão salarial').
            ' (<strong><u>'.__('bruto').' '.__(($isPerYear ? 'anual' : 'mensal')).'</u></strong>)'" />

        <input class="mt-1 text-input-select w-full" id="{{ $inputSalary }}" max="16777215" min="1"
            :value="old($inputSalary)" name="{{ $inputSalary }}" type="number">

        <x-input-error class="mt-2" :messages="$errors->get($inputSalary)" />
    </div>
</div>
