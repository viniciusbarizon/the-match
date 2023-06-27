<div class="space-y-4">
    <div>
        <x-input-label for="contract_id" id="contract_id_label" :value="__('Contrato')" />
        <x-select class="mt-1 w-full" name="contract_id" :options="$contracts" required />

        <x-input-error class="mt-2" :messages="$errors->get('contract_id')" />
    </div>

    <div>
        <x-input-label for="currency_id" id="currency_id_label" :value="__('Moeda')" />
        <x-select class="mt-1 w-full" name="currency_id" :options="$currencies" required />

        <x-input-error class="mt-2" :messages="$errors->get('currency_id')" />
    </div>

    <div>
        <x-input-label for="salary" id="salary_label" :value="__('Pretensão salarial').
            ' (<strong><u>'.__('bruto').' '.__(($isPerYear ? 'anual' : 'mensal')).'</u></strong>)'" />

        <input class="mt-1 text-input-select w-full" id="salary" max="16777215" min="1" name="salary" type="number"
            value="{{ old('salary') }}" required>

        <x-input-error class="mt-2" :messages="$errors->get('salary')" />
    </div>
</div>
