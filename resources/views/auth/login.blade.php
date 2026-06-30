<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-rental.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            font-family:'Instrument Sans',sans-serif;
            background:#030712;
        }
    </style>
</head>

<body class="bg-gray-950 text-gray-200 antialiased selection:bg-cyan-500 selection:text-gray-950">

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-950 relative overflow-hidden">

    <!-- Background Blur -->
    <div class="absolute top-[-10%] left-[-10%] w-[45rem] h-[45rem] bg-cyan-500/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[45rem] h-[45rem] bg-blue-600/5 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Logo -->
    <div class="z-10 transform transition-transform duration-300 hover:scale-105 mb-4">
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

    

    <!-- Login Card -->
    <div class="w-full sm:max-w-md px-8 py-8 bg-gradient-to-b from-gray-900 to-gray-950 border border-gray-800/80 shadow-2xl shadow-cyan-950/20 overflow-hidden sm:rounded-2xl z-10 relative">

        <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-cyan-500 to-transparent"></div>

        <div class="mb-6 text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-cyan-400">
                Otentikasi Sistem
            </p>

            <p class="text-gray-400 text-sm mt-1">
                Masuk untuk mulai memesan kendaraan
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-cyan-400 bg-cyan-950/40 p-3 rounded-lg border border-cyan-800/50">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-300 tracking-wide mb-1.5">
                    Email Address
                </label>

                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="nama@email.com"
                    class="block w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-gray-100 placeholder-gray-600 focus:outline-none focus:border-cyan-500/80 focus:ring-4 focus:ring-cyan-500/10 transition duration-200 shadow-inner">

                @if ($errors->has('email'))
                    <p class="mt-1.5 text-sm text-red-400 font-medium">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-300 tracking-wide mb-1.5">
                    Password
                </label>

                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="block w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-gray-100 placeholder-gray-600 focus:outline-none focus:border-cyan-500/80 focus:ring-4 focus:ring-cyan-500/10 transition duration-200 shadow-inner">

                @if ($errors->has('password'))
                    <p class="mt-1.5 text-sm text-red-400 font-medium">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded bg-gray-950 border-gray-800 text-cyan-500 focus:ring-cyan-500/30 focus:ring-offset-gray-950 focus:ring-2">

                    <span class="ms-2 text-sm text-gray-400 group-hover:text-gray-200 transition duration-200">
                        Ingat saya
                    </span>
                </label>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between pt-5 border-t border-gray-900 mt-2">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-gray-400 hover:text-cyan-400 transition duration-200">
                        Lupa password?
                    </a>
                @endif

                <button type="submit"
                    class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-gray-950 font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-cyan-500/20 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">

                    Log in

                </button>

            </div>
<!-- Button Back -->
    <div class="z-10 mb-6">
        <a href="{{ url('/') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
            border border-gray-700
            bg-gray-900/60
            text-gray-300
            hover:bg-cyan-500
            hover:text-gray-950
            hover:border-cyan-500
            transition-all duration-300
            shadow-lg hover:shadow-cyan-500/20">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"/>
            </svg>

            <span class="font-semibold">
                Back to home
            </span>

        </a>
    </div>
        </form>

    </div>

</div>

</body>
</html>