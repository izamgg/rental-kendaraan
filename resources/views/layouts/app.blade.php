<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RENTALKU') }}</title>

    <!-- Logo Tab Browser (Favicon) -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-rental.png') }}">

    <!-- Untuk Apple Device -->
    <link rel="apple-touch-icon" href="{{ asset('images/logo-rental.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans antialiased bg-gray-950 text-gray-200">
        <div class="min-h-screen bg-gray-950 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-cyan-500/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
            <div class="absolute bottom-0 left-0 w-[40rem] h-[40rem] bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

            <div class="relative z-30 border-b border-gray-900 bg-gray-950/60 backdrop-blur-md">
                @include('layouts.navigation')
            </div>

            @isset($header)
                <header class="bg-gray-900/30 backdrop-blur-md border-b border-gray-800/50 relative z-20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="relative z-20 max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

        </div>
    </body>
</html>