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

    <body class="antialiased font-sans text-gray-900">
        <div class="bg-green-400 flex flex-col items-center min-h-screen sm:justify-center sm:pt-0 pt-6">
            <div>
                <a href="/">
                    <x-guest.logo/>
                </a>
            </div>

            <div class="bg-white mt-6 overflow-hidden px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg w-full">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
