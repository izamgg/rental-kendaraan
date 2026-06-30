<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-wide">
                    Data Armada Vehicles
                </h2>
                <p class="text-sm text-cyan-400/70 mt-1">
                    Kelola, tambah, dan pantau status seluruh kendaraan rental Anda.
                </p>
            </div>
            
            <a href="{{ route('vehicles.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-gray-950 font-bold text-sm px-5 py-2.5 rounded-xl shadow-lg shadow-cyan-500/20 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                
                <svg class="w-4 h-4 text-gray-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>

                Tambah Kendaraan
            </a>
        </div>
    </x-slot>

    <div class="w-full pt-2">

        {{-- ✅ SUCCESS ALERT --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-500/20 border border-green-500 text-green-400 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-b from-gray-900/90 to-gray-950 border border-gray-800/80 rounded-2xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 bg-gray-900/50">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Gambar</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-cyan-400">Nama Kendaraan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-purple-400">Tipe / Jenis</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-emerald-400">Harga Per Hari</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-400 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="vehicle-table-body" class="divide-y divide-gray-800/60">
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Memuat data kendaraan...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- KODE JAVASCRIPT FIXED --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tableBody = document.getElementById("vehicle-table-body");

            // Mengambil data dari routes/api.php yang baru saja kamu ubah
            fetch("/api/vehicles")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Gagal mengambil data dari API");
                    }
                    return response.json();
                })
                .then(data => {
                    tableBody.innerHTML = ""; // Hapus teks "Memuat data..."

                    if (data.length === 0) {
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <span class="text-3xl">🚗</span>
                                        <p class="text-sm">Belum ada armada kendaraan yang terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    // Looping data array dari Vehicle::latest()->get()
                    data.forEach(v => {
                        // Cek ketersediaan gambar kendaraan
                        const imgHtml = v.image 
                            ? `<img src="/storage/${v.image}" alt="${v.name}" class="w-full h-full object-cover">`
                            : `<span class="text-xl">🚗</span>`;

                        // Format mata uang Rupiah
                        const formattedPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(v.price_per_day).replace("IDR", "Rp");

                        // Render baris tabel secara dinamis
                        const row = `
                            <tr class="group hover:bg-gray-900/30 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded-xl bg-gray-900 border border-gray-800 overflow-hidden flex items-center justify-center">
                                        ${imgHtml}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-cyan-500/10 rounded-lg text-cyan-400 group-hover:bg-cyan-500/20 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125a1.125 1.125 0 0 0 1.125-1.125V11.25a9 9 0 0 0-9-9h-6a3.75 3.75 0 0 0-3.75 3.75v6.523c0 .542.233 1.059.646 1.422L6.75 18"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-white tracking-wide">${v.name}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                        ${v.type}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-emerald-400">
                                        ${formattedPrice} <span class="text-xs text-gray-500 font-normal">/hari</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="/vehicles/${v.id}/edit" class="text-gray-400 hover:text-cyan-400 transition-colors font-semibold text-xs uppercase tracking-wider">
                                            Edit
                                        </a>
                                        <span class="text-gray-800">|</span>
                                        <form action="/vehicles/${v.id}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-gray-500 hover:text-rose-400 transition-colors font-semibold text-xs uppercase tracking-wider">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    tableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-400">Gagal memuat data. silakan periksa koneksi atau console log.</td></tr>`;
                });
        });
    </script>
</x-app-layout>