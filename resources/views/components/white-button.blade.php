@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} type="button"
    {!! $attributes->merge(['class' => 'bg-white border border-gray-300 disabled:opacity-25 duration-150 ease-in-out
        focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-outset font-semibold hover:bg-gray-50
        inline-flex items-center px-4 py-2 rounded-md shadow-sm text-gray-700 text-xs tracking-widest transition
        uppercase'
    ]) !!}
>
    {{ $slot }}
</button>
