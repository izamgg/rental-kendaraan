<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">
            Data Rental (Admin)
        </h2>
    </x-slot>

    <div class="p-6 text-white">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-500/20 border border-green-500 text-green-400 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-gray-900 border border-gray-800 rounded-xl shadow-lg">
            <table class="w-full text-sm text-left">
                
                <thead class="bg-gray-800 text-gray-300 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">User</th>
                        <!-- MODIFIKASI: Ditambahkan sedikit padding agar proporsional -->
                        <th class="px-4 py-3">Kendaraan</th>
                        <th class="px-4 py-3">Hari</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($rentals as $r)
                        <tr class="border-b border-gray-800 hover:bg-gray-800/40 transition">

                            <td class="px-4 py-3 font-medium">
                                {{ $r->user->name }}
                            </td>

                            {{-- MODIFIKASI: Gabungkan Gambar & Nama Kendaraan berdampingan --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <!-- Bingkai Gambar Mini -->
                                    <div class="w-14 h-10 rounded-lg bg-gray-950 border border-gray-800 overflow-hidden flex items-center justify-center flex-shrink-0">
                                        @if($r->vehicle && $r->vehicle->image)
                                            <img src="{{ asset('storage/' . $r->vehicle->image) }}" alt="{{ $r->vehicle->name }}" class="w-full h-full object-cover">
                                        @else
                                            <!-- Fallback emoji jika data kendaraan atau gambar kosong -->
                                            <span class="text-lg">🚗</span>
                                        @endif
                                    </div>
                                    <!-- Nama Kendaraan -->
                                    <span class="font-semibold tracking-wide">
                                        {{ $r->vehicle->name ?? 'Kendaraan Terhapus' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-gray-400">
                                {{ $r->days }} hari
                            </td>

                            <td class="px-4 py-3 text-emerald-400 font-semibold">
                                Rp {{ number_format($r->total_price, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-4 py-3">
                                @switch($r->status)
                                    @case('pending')
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 font-semibold">
                                            ⏳ Pending
                                        </span>
                                    @break

                                    @case('approved')
                                        <span class="px-2 py-1 text-xs rounded bg-green-500/20 text-green-400 border border-green-500/30 font-semibold">
                                            ✅ Approved
                                        </span>
                                    @break

                                    @case('rejected')
                                        <span class="px-2 py-1 text-xs rounded bg-red-500/20 text-red-400 border border-red-500/30 font-semibold">
                                            ❌ Rejected
                                        </span>
                                    @break
                                @endswitch
                            </td>

                            {{-- AKSI --}}
                            <td class="px-4 py-3">
                                @if($r->status === 'pending')

                                    <form action="{{ route('rental.approve', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button 
                                            onclick="return confirm('Setujui rental ini?')"
                                            class="bg-green-600 hover:bg-green-500 px-3 py-1 rounded text-xs font-bold transition">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('rental.reject', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button 
                                            onclick="return confirm('Tolak rental ini?')"
                                            class="bg-red-600 hover:bg-red-500 px-3 py-1 rounded text-xs font-bold transition">
                                            Reject
                                        </button>
                                    </form>

                                @elseif($r->status === 'approved')
                                    <span class="text-green-400 text-xs font-semibold">
                                        ✔ Sudah disetujui
                                    </span>

                                @elseif($r->status === 'rejected')
                                    <span class="text-red-400 text-xs font-semibold">
                                        ✖ Ditolak
                                    </span>
                                @endif
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500 italic">
                                Belum ada data rental
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</x-app-layout>