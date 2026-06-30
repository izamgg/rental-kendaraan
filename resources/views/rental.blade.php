<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-wide">
                    Rental Kendaraan
                </h2>
                <p class="text-sm text-cyan-400/70 mt-1">Pilih armada terbaik dan tentukan durasi sewa Anda secara real-time.</p>
            </div>
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900/50 border border-gray-800">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Sistem Transaksi
                </span>
            </div>
        </div>
    </x-slot>

    <!-- Mengubah max-w agar muat grid card berdampingan -->
    <div class="max-w-5xl mx-auto pt-2 pb-12 px-4">
        <div class="bg-gradient-to-b from-gray-900/90 to-gray-950 border border-gray-800/80 rounded-[24px] shadow-2xl overflow-hidden relative">
            <div class="h-1 bg-gradient-to-r from-emerald-500 to-cyan-500"></div>

            <form action="/rent" method="POST" class="p-8 md:p-10 space-y-8">
                @csrf

                <div class="border-b border-gray-900 pb-4">
                    <h3 class="font-bold text-white text-lg tracking-wide">
                        Formulir Pemesanan Rental
                    </h3>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Silakan pilih kendaraan di bawah dan tentukan durasi sewa.
                    </p>
                </div>

                <!-- BAGIAN BARU: Grid Card Kendaraan -->
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-300">
                        Pilih Kendaraan Armada
                    </label>
                    
                    <!-- Input select asli disembunyikan (hidden) namun nilainya tetap diisi via Javascript -->
                    <select name="vehicle_id" id="vehicle" required class="hidden">
                        <option value="">-- Pilih Kendaraan Anda --</option>
                        @foreach($vehicles as $v)
                            <option value="{{ $v->id }}">
                                {{ $v->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Tampilan Card Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($vehicles as $v)
                            <div type="button" data-id="{{ $v->id }}"
                                class="vehicle-card group cursor-pointer bg-gray-950 border border-gray-800 rounded-2xl overflow-hidden transition-all duration-200 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/5">
                                
                                <!-- Container Gambar Kendaraan -->
                                <div class="h-44 w-full bg-gray-900 relative overflow-hidden flex items-center justify-center border-b border-gray-900">
                                    @if($v->image) 
                                        <!-- Pastikan field 'image' sesuai dengan nama kolom di database Anda -->
                                        <img src="{{ asset('storage/' . $v->image) }}" alt="{{ $v->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <!-- Fallback jika admin lupa upload gambar -->
                                        <div class="text-center p-4">
                                            <span class="text-4xl">🚗</span>
                                            <p class="text-xs text-gray-500 mt-1">Tidak ada gambar</p>
                                        </div>
                                    @endif
                                    
                                    <!-- Badge Harga Sewa Per Hari -->
                                    <div class="absolute bottom-3 right-3 bg-gray-950/80 backdrop-blur-md border border-gray-800 px-3 py-1 rounded-lg">
                                        <p class="text-xs font-bold text-emerald-400">
                                            Rp {{ number_format($v->price_per_day, 0, ',', '.') }}<span class="text-gray-400 font-normal">/hari</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Detail Info Kendaraan -->
                                <div class="p-4 flex items-center justify-between">
                                    <div>
                                        <h4 class="font-bold text-white group-hover:text-emerald-400 transition">
                                            {{ $v->name }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-0.5">Tersedia untuk disewa</p>
                                    </div>
                                    <!-- Indikator Centang Ghaib (Aktif saat dipilih) -->
                                    <div class="checkbox-indicator w-5 h-5 rounded-full border border-gray-800 flex items-center justify-center text-xs text-transparent font-bold">
                                        ✓
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Bagian Input Durasi -->
                <div class="max-w-xs">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Durasi Sewa (Hari)
                    </label>
                    <input type="number" name="days" id="days" min="1" required placeholder="Contoh: 3"
                        class="w-full rounded-xl border border-gray-800 bg-gray-950 px-4 py-3 text-white placeholder-gray-600 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/80 transition duration-200">
                </div>

                <!-- Total Biaya Estimasi -->
                <div class="bg-gradient-to-r from-emerald-950/20 to-cyan-950/20 border border-emerald-500/20 rounded-2xl p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Estimasi Total Biaya</h4>
                        <p class="text-sm text-gray-400 mt-0.5">Nilai ini dihitung otomatis berdasarkan durasi hari.</p>
                    </div>
                    <div>
                        <span id="total" class="text-3xl font-black text-white tracking-wide bg-gradient-to-r from-white to-gray-300 bg-clip-text">
                            Rp 0
                        </span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <button type="submit"
                        class="w-full sm:w-auto px-10 py-3.5 rounded-xl text-gray-950 font-bold text-sm bg-gradient-to-r from-emerald-500 to-cyan-500 hover:from-emerald-400 hover:to-cyan-400 shadow-lg shadow-emerald-500/10 hover:scale-[1.01] active:scale-[0.99] transition duration-150">
                        ⚡ Sewa Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Logic ketika salah satu card kendaraan diklik oleh customer
$('.vehicle-card').on('click', function() {
    let selectedId = $(this).data('id');
    
    // 1. Ubah value di select asli yang kita sembunyikan tadi
    $('#vehicle').val(selectedId).trigger('change');
    
    // 2. Berikan efek visual aktif/terpilih pada card
    $('.vehicle-card').removeClass('border-emerald-500 bg-emerald-950/10').addClass('border-gray-800 bg-gray-950');
    $('.checkbox-indicator').removeClass('bg-emerald-500 text-gray-950 border-emerald-500').addClass('border-gray-800 text-transparent');
    
    $(this).removeClass('border-gray-800 bg-gray-950').addClass('border-emerald-500 bg-emerald-950/10');
    $(this).find('.checkbox-indicator').removeClass('border-gray-800 text-transparent').addClass('bg-emerald-500 text-gray-950 border-emerald-500');
});

// Fungsi AJAX hitung otomatis bawaan Anda (tetap dipertahankan tanpa diubah fungsinya)
$('#vehicle, #days').on('change keyup', function() {
    let id = $('#vehicle').val();
    let days = $('#days').val();

    if (id && days) {
        $.get(`/calculate/${id}/${days}`, function(res) {
            let formattedTotal = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(res.total);
            
            $('#total').text(formattedTotal);
        });
    } else {
        $('#total').text('Rp 0');
    }
});
</script>
