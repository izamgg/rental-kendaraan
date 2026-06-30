<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-white tracking-wide">
                    Tambah Kendaraan Baru
                </h2>
                <p class="text-sm text-cyan-400/70 mt-1">Isi detail spesifikasi armada kendaraan untuk dipublikasikan ke pelanggan.</p>
            </div>
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900/50 border border-gray-800">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Fleet Management
                </span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pt-2 pb-12">
        <div class="bg-gradient-to-b from-gray-900/90 to-gray-950 border border-gray-800/80 rounded-[24px] shadow-2xl overflow-hidden relative">
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-blue-600"></div>

            <form action="/vehicles" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                @csrf

                <div class="border-b border-gray-900 pb-4">
                    <h3 class="font-bold text-white text-lg tracking-wide">
                        Informasi Kendaraan
                    </h3>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Data utama kendaraan yang akan ditambahkan ke sistem rental.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Nama Kendaraan
                        </label>
                        <input type="text" name="name" required
                            placeholder="Toyota Fortuner VRZ"
                            class="w-full rounded-xl border border-gray-800 bg-gray-950 px-4 py-3 text-white placeholder-gray-600
                            focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500/80 transition duration-200">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Jenis Kendaraan
                        </label>
                        <select name="type" required
                            class="w-full rounded-xl border border-gray-800 bg-gray-950 px-4 py-3 text-white
                            focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500/80 transition duration-200">
                            <option value="Mobil" class="bg-gray-950 text-white">🚗 Mobil</option>
                            <option value="Motor" class="bg-gray-950 text-white">🏍 Motor</option>
                            <option value="Pickup" class="bg-gray-950 text-white">🛻 Pickup</option>
                            <option value="Truck" class="bg-gray-950 text-white">🚚 Truck</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Harga Sewa / Hari
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-cyan-400">
                            Rp
                        </span>
                        <input type="number" name="price_per_day" required placeholder="500000"
                            class="w-full pl-12 rounded-xl border border-gray-800 bg-gray-950 px-4 py-3 text-white placeholder-gray-600
                            focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500/80 transition duration-200">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Deskripsi Kendaraan
                    </label>
                    <textarea rows="4" name="description" placeholder="Fasilitas, spesifikasi, kondisi mesin, atau ketentuan sewa..."
                        class="w-full rounded-xl border border-gray-800 bg-gray-950 px-4 py-3 text-white placeholder-gray-600
                        focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500/80 transition duration-200"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">
                        Upload Foto Unit
                    </label>

                    <div id="uploadArea"
                        class="border-2 border-dashed border-gray-800 hover:border-cyan-500/50 rounded-2xl p-8 bg-gray-950/60
                        hover:bg-gray-950 transition-all duration-300 text-center cursor-pointer group">

                        <input type="file" name="image" id="image-upload" class="hidden" onchange="previewImage(event)">

                        <label for="image-upload" class="cursor-pointer">
                            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-200">
                                📸
                            </div>
                            <h4 class="font-semibold text-gray-200 group-hover:text-cyan-400 transition-colors">
                                Pilih Berkas Foto Kendaraan
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">
                                Format gambar: PNG, JPG, JPEG (Maks. 2 MB)
                            </p>
                            
                            <img id="preview" class="hidden mt-6 mx-auto rounded-xl w-64 border border-gray-800 shadow-2xl">
                        </label>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-900">
                    <a href="/vehicles"
                        class="px-6 py-3 rounded-xl bg-gray-900 border border-gray-800 text-gray-400 font-semibold text-sm
                        hover:bg-gray-800 hover:text-white transition duration-150 text-center">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-8 py-3 rounded-xl text-gray-950 font-bold text-sm
                        bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500
                        shadow-lg shadow-cyan-500/10 hover:scale-[1.01] active:scale-[0.99] transition duration-150">
                        ✨ Simpan Kendaraan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
}
</script>