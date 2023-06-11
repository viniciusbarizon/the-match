<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{ $title }}
        </title>

        <x-favicon/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased bg-green-400 font-sans text-gray-900">
        <div class="flex flex-col items-center sm:justify-center">
            <x-logo/>

            <div class="bg-white overflow-hidden px-4 py-4 shadow-md sm:max-w-md sm:rounded-lg w-full">
                {{ $slot }}
            </div>

            <x-contact />
        </div>

        @livewireScripts
    </body>
</html>
