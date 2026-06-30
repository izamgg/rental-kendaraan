<x-app-layout>

    <!-- Tambahkan Library ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    @if(Auth::user()->role == 'admin')
                        Dashboard Admin
                    @else
                        Dashboard Pelanggan
                    @endif
                </h2>
                <p class="text-gray-400 mt-1">
                    Selamat datang di Sistem Rental Kendaraan
                </p>
            </div>

            <div class="bg-cyan-500/10 border border-cyan-500/20 px-4 py-2 rounded-lg">
                <span class="text-cyan-400 font-semibold uppercase text-xs">
                    Role: {{ Auth::user()->role }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">

        <!-- ==================== KARTU STATISTIK UTAMA ==================== -->
        @if(Auth::user()->role == 'admin')
            <!-- Tampilan Kartu untuk Admin -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kendaraan -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                    <h3 class="text-cyan-400 text-sm uppercase font-semibold">Total Kendaraan</h3>
                    <p class="text-5xl font-bold text-white mt-4">{{ $vehicles ?? 0 }}</p>
                    <p class="text-gray-400 mt-3">Unit kendaraan tersedia</p>
                </div>

                <!-- Rental -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                    <h3 class="text-green-400 text-sm uppercase font-semibold">Total Rental</h3>
                    <p class="text-5xl font-bold text-white mt-4">{{ $rentals ?? 0 }}</p>
                    <p class="text-gray-400 mt-3">Transaksi rental global</p>
                </div>

                <!-- User -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                    <h3 class="text-purple-400 text-sm uppercase font-semibold">Total User</h3>
                    <p class="text-5xl font-bold text-white mt-4">{{ $users ?? 0 }}</p>
                    <p class="text-gray-400 mt-3">Pengguna terdaftar</p>
                </div>
            </div>
        @else
            <!-- Tampilan Kartu untuk User Biasa (Grid Diubah Menjadi 5 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 shadow-lg">
                    <h3 class="text-cyan-400 text-xs uppercase font-semibold">Total Pengajuan</h3>
                    <p class="text-4xl font-bold text-white mt-3">{{ $rentals ?? 0 }}</p>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 shadow-lg">
                    <h3 class="text-green-400 text-xs uppercase font-semibold">Sewa Disetujui</h3>
                    <p class="text-4xl font-bold text-white mt-3">{{ $approved ?? 0 }}</p>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 shadow-lg">
                    <h3 class="text-amber-400 text-xs uppercase font-semibold">Menunggu</h3>
                    <p class="text-4xl font-bold text-white mt-3">{{ $pending ?? 0 }}</p>
                </div>

                <!-- KARTU BARU: SEWA DITOLAK -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 shadow-lg">
                    <h3 class="text-red-400 text-xs uppercase font-semibold">Sewa Ditolak</h3>
                    <p class="text-4xl font-bold text-white mt-3">{{ $rejected ?? 0 }}</p>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 shadow-lg">
                    <h3 class="text-purple-400 text-xs uppercase font-semibold">Total Pengeluaran</h3>
                    <p class="text-xl font-bold text-white mt-4 truncate">
                        Rp{{ number_format($totalSpent ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        @endif


        <!-- ==================== PHP LOGIC UNTUK GRAFIK REAL DATA ==================== -->
        @php
            $currentYear = date('Y');
            $monthlyData = [];
            
            // 1. Ambil data transaksi bulanan (Jika admin tampilkan global, jika user tampilkan datanya sendiri)
            for ($month = 1; $month <= 12; $month++) {
                $query = \App\Models\Rental::whereYear('created_at', $currentYear)->whereMonth('created_at', $month);
                
                if (Auth::user()->role != 'admin') {
                    $query->where('user_id', Auth::user()->id);
                }
                
                $monthlyData[] = $query->count();
            }

            // 2. Data Donut Chart (Sudah dikirim rapi dari Controller ke masing-masing role)
            $statusData = [$approved ?? 0, $pending ?? 0, $rejected ?? 0];
        @endphp


        <!-- ==================== BAGIAN GRAFIK REAL DATA ==================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
            
            <!-- Grafik Kiri: Tren Bulanan -->
            <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-bold text-white">Tren Aktivitas Rental</h4>
                        <p class="text-xs text-gray-400">
                            {{ Auth::user()->role == 'admin' ? 'Statistik transaksi masuk per bulan secara keseluruhan' : 'Statistik riwayat sewa pribadi Anda per bulan' }}
                        </p>
                    </div>
                    <span class="text-xs font-medium text-cyan-400 bg-cyan-950/40 border border-cyan-800/40 px-2.5 py-1 rounded-md">
                        Tahun {{ $currentYear }}
                    </span>
                </div>
                <div id="rentalsTrendChart" class="w-full"></div>
            </div>

            <!-- Grafik Kanan: Komposisi Status Transaksi -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg flex flex-col justify-between">
                <div>
                    <h4 class="text-lg font-bold text-white mb-1">Status Rental</h4>
                    <p class="text-xs text-gray-400 mb-6">Perbandingan status persetujuan transaksi saat ini</p>
                </div>
                <div class="flex justify-center items-center my-auto">
                    <div id="rentalStatusChart" class="w-full"></div>
                </div>
            </div>

        </div>


        <!-- ==================== WELCOME / ACTION CARD ==================== -->
        @if(Auth::user()->role == 'admin')
            <div class="mt-8 bg-gradient-to-r from-cyan-900/20 to-blue-900/20 border border-cyan-500/20 rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-white mb-2">Selamat Datang Admin 👋</h3>
                <p class="text-gray-300">Kelola kendaraan, pantau transaksi rental, dan lihat data pengguna melalui dashboard ini.</p>
            </div>
        @else
            <div class="mt-8 bg-gradient-to-r from-emerald-900/20 to-teal-900/20 border border-emerald-500/20 rounded-2xl p-8 flex flex-col sm:flex-row items-sm-center justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-300">Ingin melakukan perjalanan atau butuh angkutan armada? Klik halaman rental untuk memesan kendaraan.</p>
                </div>
            </div>
        @endif

    </div>

    <!-- Script Inisialisasi Grafik -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // 1. Inisialisasi Tren Bulanan
            const trendOptions = {
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: { show: false },
                    fontFamily: 'inherit',
                    foreColor: '#9ca3af'
                },
                colors: ['#06b6d4'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                series: [{
                    name: 'Jumlah Transaksi',
                    data: @json($monthlyData) 
                }],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                grid: {
                    borderColor: '#1f2937',
                    xaxis: { lines: { show: false } }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { tickAmount: 4 },
                tooltip: { theme: 'dark' }
            };

            // 2. Inisialisasi Donut Chart berdasarkan Status
            const statusOptions = {
                chart: {
                    type: 'donut',
                    height: 280,
                    fontFamily: 'inherit',
                },
                series: @json($statusData), 
                labels: ['Disetujui (Approved)', 'Menunggu (Pending)', 'Ditolak (Rejected)'],
                colors: ['#10b981', '#f59e0b', '#ef4444'],
                stroke: { colors: ['#111827'] },
                legend: {
                    position: 'bottom',
                    labels: { colors: '#9ca3af' }
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: { enabled: false }
                },
                theme: { mode: 'dark' },
                tooltip: { theme: 'dark' }
            };

            // Render grafik ke view
            new ApexCharts(document.querySelector("#rentalsTrendChart"), trendOptions).render();
            new ApexCharts(document.querySelector("#rentalStatusChart"), statusOptions).render();
        });
    </script>

</x-app-layout>