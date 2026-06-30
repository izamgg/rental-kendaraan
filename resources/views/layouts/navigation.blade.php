<nav x-data="{ open: false }" class="bg-gray-950/80 backdrop-blur-md border-b border-gray-900 sticky top-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

          <!-- Logo -->
<div class="flex">
    <div class="shrink-0 flex items-center">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 hover:scale-105 transition duration-300">

            <img src="{{ asset('images/logo-rental.png') }}"
                 alt="Logo RENTALKU"
                 class="w-11 h-11 object-contain">

            <div class="leading-tight">
                <h1 class="text-xl font-black tracking-wider text-cyan-400">
                    RENTALKU
                </h1>
                <p class="text-[10px] text-gray-400">
                    Rental Kendaraan
                </p>
            </div>

        </a>
    </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex space-x-8 sm:ms-10">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @auth

                        {{-- ================= ADMIN ================= --}}
                        @if(auth()->user()->role === 'admin')

                            <x-nav-link href="{{ route('vehicles.index') }}"
                                :active="request()->is('vehicles*')">
                                Vehicles
                            </x-nav-link>

                            <x-nav-link href="{{ url('/admin/rental') }}"
                                :active="request()->is('admin/rental*')">
                                Data Rental
                            </x-nav-link>

                        @endif

                        {{-- ================= USER ================= --}}
                        @if(auth()->user()->role === 'user')

                            <x-nav-link href="{{ url('/rental') }}"
                                :active="request()->is('rental')">
                                Rental
                            </x-nav-link>

                            <x-nav-link href="{{ url('/my-rental') }}"
                                :active="request()->is('my-rental')">
                                My Rental
                            </x-nav-link>

                        @endif

                    @endauth

                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-800 rounded-xl text-sm text-gray-300 bg-gray-900/50 hover:bg-gray-900">

                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-cyan-500 to-teal-500 flex items-center justify-center text-[10px] text-gray-950 font-bold">
                                    {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                                </div>
                                {{ Auth::user()->name }}
                            </div>

                            <svg class="ms-2 h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-2 text-xs text-cyan-400 font-bold border-b border-gray-800 bg-gray-900">
                            Manajemen Akun
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-rose-400">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Mobile Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="p-2 text-cyan-400 hover:bg-gray-900 rounded-xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden bg-gray-950 border-t border-gray-900">

        <x-responsive-nav-link :href="route('dashboard')">
            Dashboard
        </x-responsive-nav-link>

        @auth

            @if(auth()->user()->role === 'admin')

                <x-responsive-nav-link href="{{ route('vehicles.index') }}">
                    Vehicles
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ url('/admin/rental') }}">
                    Data Rental
                </x-responsive-nav-link>

            @endif

            @if(auth()->user()->role === 'user')

                <x-responsive-nav-link href="{{ url('/rental') }}">
                    Rental
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ url('/my-rental') }}">
                    My Rental
                </x-responsive-nav-link>

            @endif

        @endauth

    </div>

</nav>