<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-wide">
                    Riwayat Rental Saya
                </h2>
                <p class="text-sm text-cyan-400/70 mt-1">
                    Pantau status transaksi, durasi sewa, dan seluruh armada yang pernah Anda pesan.
                </p>
            </div>
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900/50 border border-gray-800">
                <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Log Aktivitas
                </span>
            </div>
        </div>
    </x-slot>

    <div class="w-full pt-2 pb-12">
        <!-- ==================== NOTIFIKASI PEMBATALAN ==================== -->
        @if(session('success'))
            <div id="success-alert" class="mb-6 max-w-xl mx-auto flex items-start gap-4 p-4 rounded-xl bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 shadow-xl transition-all duration-300">
                <div class="flex items-center justify-center p-1.5 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-md">
                    ✓
                </div>
                <div class="flex-1">
                    <p class="text-sm text-emerald-300">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="document.getElementById('success-alert').remove()" class="text-gray-500 hover:text-white transition text-xs p-1">
                    ✕
                </button>
            </div>
        @endif

        @if($rentals->count() == 0)
            <div class="max-w-md mx-auto text-center bg-gray-900/50 border border-gray-800/80 rounded-2xl p-8 shadow-xl mt-6">
                <div class="text-5xl mb-4">📋</div>
                <h3 class="text-white font-bold text-lg">Belum Ada Riwayat</h3>
                <p class="text-gray-500 text-sm mt-1">
                    Anda belum melakukan transaksi rental kendaraan apa pun saat ini.
                </p>
                <a href="/rental" class="mt-5 inline-block text-xs font-bold text-gray-950 bg-cyan-400 hover:bg-cyan-300 px-4 py-2 rounded-lg transition-colors">
                    Sewa Kendaraan Sekarang
                </a>
            </div>
        @endif

        @if($rentals->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($rentals as $r)
                    <div class="group bg-gradient-to-br from-gray-900 via-gray-900 to-gray-950 border border-gray-800/80 rounded-2xl p-6 shadow-xl relative overflow-hidden flex flex-col sm:flex-row justify-between gap-6 hover:border-purple-500/30 transition-all duration-300">
                        
                        <div class="flex-1 flex flex-col justify-between space-y-4">

                            <!-- TYPE + NAMA -->
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-purple-500/10 text-purple-400 border border-purple-500/20 mb-2">
                                    {{ $r->vehicle->type }}
                                </span>

                                <h3 class="text-xl font-bold text-white tracking-wide group-hover:text-cyan-400 transition-colors">
                                    {{ $r->vehicle->name }}
                                </h3>
                            </div>

                            <!-- STATUS + INFO -->
                            <div class="space-y-1.5 text-sm text-gray-400">

                                <!-- STATUS BADGE -->
                                <div class="mb-2">
                                    @if($r->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                            ⏳ Menunggu
                                        </span>
                                    @elseif($r->status == 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-500/10 text-green-400 border border-green-500/20">
                                            ✅ Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-red-500/10 text-red-400 border border-red-500/20">
                                            ❌ Ditolak
                                        </span>
                                    @endif
                                </div>

                                <!-- DURASI -->
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-600">Durasi Sewa:</span>
                                    <span class="font-semibold text-gray-200">{{ $r->days }} Hari</span>
                                </div>

                                <!-- TOTAL -->
                                <div class="flex items-center gap-2 pt-1 border-t border-gray-800/50">
                                    <span class="text-gray-600">Total Bayar:</span>
                                    <span class="font-black text-emerald-400 text-base">
                                        Rp {{ number_format($r->total_price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <!-- TOMBOL BATAL (HANYA MUNCUL JIKA PENDING) -->
                                @if($r->status == 'pending')
                                    <div class="pt-3">
                                        <form action="/rent/{{ $r->id }}/cancel" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan penyewaan armada ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-red-400 bg-red-500/10 border border-red-500/20 hover:bg-red-500 hover:text-white transition duration-150">
                                                🛑 Batal Sewa
                                            </button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- GAMBAR -->
                        <div class="sm:w-36 flex items-center justify-center shrink-0">
                            @if($r->vehicle->image)
                                <div class="w-full h-24 sm:h-28 rounded-xl overflow-hidden bg-gray-950 border border-gray-800 relative group-hover:border-gray-700 transition-colors">
                                    <img src="{{ asset('storage/'.$r->vehicle->image) }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                                         alt="{{ $r->vehicle->name }}">
                                </div>
                            @else
                                <div class="w-full h-24 sm:h-28 rounded-xl bg-gray-950 border border-gray-800 flex flex-col items-center justify-center text-2xl text-gray-700">
                                    🚗
                                    <span class="text-[9px] text-gray-600 font-bold uppercase tracking-wider mt-1">
                                        No Photo
                                    </span>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Efek auto-hide notifikasi sukses pembatalan setelah 5 detik
if ($('#success-alert').length > 0) {
    setTimeout(function() {
        $('#success-alert').fadeOut(500, function() {
            $(this).remove();
        });
    }, 5000);
}
</script>