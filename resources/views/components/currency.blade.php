<div class="mb-4">
    <x-input-label dusk="{{ $input }}_label" for="{{ $input }}" :value="__('Moeda')" />

    <select class="mt-1 text-input-select w-full" dusk="{{ $input }}" id="{{ $input }}" name="{{ $input }}" required>
        @foreach ($currencies as $id => $name)
            <option value="{{ $id }}">
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
