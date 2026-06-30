<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RENTALKU') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-rental.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #030712;
        }
    </style>
</head>

<body class="bg-gray-950 text-gray-200 antialiased selection:bg-cyan-500 selection:text-gray-950">

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-950 relative overflow-hidden">

        <div
            class="absolute top-[-20%] left-[-10%] w-[40rem] h-[40rem] bg-cyan-950/20 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-20%] right-[-10%] w-[40rem] h-[40rem] bg-teal-950/20 rounded-full blur-[120px] pointer-events-none">
        </div>

       <div class="z-10 transform transition-transform duration-300 hover:scale-105 mb-6">
    <a href="{{ url('/') }}" class="flex flex-col items-center">

        <img src="{{ asset('images/logo-rental.png') }}"
             alt="Logo RENTALKU"
             class="w-24 h-24 object-contain drop-shadow-[0_0_25px_rgba(34,211,238,0.35)]">

        <h1 class="mt-3 text-3xl font-black tracking-widest text-cyan-400">
            RENTALKU
        </h1>

        <p class="text-gray-400 text-sm mt-1">
            Rental Kendaraan
        </p>

    </a>
</div>
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 bg-gradient-to-b from-gray-900/80 to-gray-950/90 backdrop-blur-xl border border-gray-800/80 shadow-2xl shadow-cyan-950/10 overflow-hidden sm:rounded-2xl z-10 transition-all duration-300 relative group">

            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-[1px] bg-gradient-to-r from-transparent via-cyan-500 to-transparent">
            </div>

            <div class="mb-6 text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-cyan-400/80">Otentikasi Sistem</p>
            </div>

            {{ $slot }}
        </div>

    </div>
</body>

</html>
