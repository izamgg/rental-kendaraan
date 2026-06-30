<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    Dashboard Admin
                </h2>
                <p class="text-gray-400 mt-1">
                    Selamat datang di Sistem Rental Kendaraan
                </p>
            </div>

            <div class="bg-cyan-500/10 border border-cyan-500/20 px-4 py-2 rounded-lg">
                <span class="text-cyan-400 font-semibold">
                    Online
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Kendaraan -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-cyan-400 text-sm uppercase font-semibold">
                    Total Kendaraan
                </h3>

                <p class="text-5xl font-bold text-white mt-4">
                    {{ $vehicles ?? 0 }}
                </p>

                <p class="text-gray-400 mt-3">
                    Unit kendaraan tersedia
                </p>
            </div>

            <!-- Rental -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-green-400 text-sm uppercase font-semibold">
                    Total Rental
                </h3>

                <p class="text-5xl font-bold text-white mt-4">
                    {{ $rentals ?? 0 }}
                </p>

                <p class="text-gray-400 mt-3">
                    Transaksi rental
                </p>
            </div>

            <!-- User -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-purple-400 text-sm uppercase font-semibold">
                    Total User
                </h3>

                <p class="text-5xl font-bold text-white mt-4">
                    {{ $users ?? 0 }}
                </p>

                <p class="text-gray-400 mt-3">
                    Pengguna terdaftar
                </p>
            </div>

        </div>

        <!-- Welcome Card -->
        <div class="mt-8 bg-gradient-to-r from-cyan-900/20 to-blue-900/20 border border-cyan-500/20 rounded-2xl p-8">

            <h3 class="text-2xl font-bold text-white mb-2">
                Selamat Datang Admin 👋
            </h3>

            <p class="text-gray-300">
                Kelola kendaraan, pantau transaksi rental, dan lihat data pengguna melalui dashboard ini.
            </p>

        </div>

    </div>

</x-app-layout>