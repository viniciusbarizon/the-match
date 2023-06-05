<div>
    <x-input-label dusk="{{ $input }}_label" for="{{ $input }}" :value="__('Contrato')" />

    <select class="mt-1 text-input-select w-full" dusk="{{ $input }}" id="{{ $input }}" name="{{ $input }}" required>
        @foreach ($contracts as $id => $name)
            <option value="{{ $id }}">
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
