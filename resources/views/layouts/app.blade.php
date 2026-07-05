<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

        @yield('title', 'Sistem Monitoring Dana Bantuan Studi')

    </title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- CSS & JS --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">

        @include('layouts.navigation')

        @isset($header)

            <header class="bg-white border-b shadow-sm">

                <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset

        <main>

            {{ $slot }}

        </main>

    </div>

    @stack('scripts')

</body>

</html>