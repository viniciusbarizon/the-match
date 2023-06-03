<div class="mb-4">
    <x-input-label for="contract" :value="__('Contrato')" />

    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full">
        @foreach ($contracts as $id => $name)
            <option value="{{ $id }}">
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
