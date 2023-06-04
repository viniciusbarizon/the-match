<div class="mb-4">
    <x-input-label for="contract" :value="__('Contrato')" />

    <select class="mt-1 text-input-select w-full" dusk="{{ $input }}" id="{{ $input }}" name="{{ $input }}" required>
        @foreach ($contracts as $id => $name)
            <option value="{{ $id }}">
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
