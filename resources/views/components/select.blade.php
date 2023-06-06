@props(['name', 'options'])

<select dusk="{{ $name }}" id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'text-input-select']) }}
>
    @foreach ($options as $id => $text)
        <option value="{{ $id }}">
            {{ $text }}
        </option>
    @endforeach
</select>
