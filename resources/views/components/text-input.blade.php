@props([
    'disabled' => false,
    'readonly' => false,
])

<input {{ $disabled ? 'disabled' : '' }} {{ isset($readonly) && $readonly ? 'readonly' : '' }}
    {!! $attributes->merge(['class' => 'text-input-select']) !!}
>
