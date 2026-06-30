<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">
            Edit Kendaraan
        </h2>
    </x-slot>

    <div class="p-6 text-white max-w-2xl mx-auto">

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500 text-red-400 rounded-lg">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-lg">

            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- 🔥 WAJIB --}}

                {{-- NAMA --}}
                <div class="mb-4">
                    <label class="block text-sm mb-1 text-gray-400">Nama Kendaraan</label>
                    <input type="text" name="name"
                        value="{{ old('name', $vehicle->name) }}"
                        class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded text-white">
                </div>

                {{-- TIPE --}}
                <div class="mb-4">
                    <label class="block text-sm mb-1 text-gray-400">Tipe</label>
                    <input type="text" name="type"
                        value="{{ old('type', $vehicle->type) }}"
                        class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded text-white">
                </div>

                {{-- HARGA --}}
                <div class="mb-4">
                    <label class="block text-sm mb-1 text-gray-400">Harga per Hari</label>
                    <input type="number" name="price_per_day"
                        value="{{ old('price_per_day', $vehicle->price_per_day) }}"
                        class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded text-white">
                </div>

                {{-- GAMBAR --}}
                <div class="mb-4">
                    <label class="block text-sm mb-1 text-gray-400">Gambar</label>

                    {{-- tampilkan gambar lama --}}
                    @if($vehicle->image)
                        <img src="{{ asset('storage/' . $vehicle->image) }}"
                             class="w-32 mb-2 rounded">
                    @endif

                    <input type="file" name="image"
                        class="w-full text-sm text-gray-300">
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">
                    <label class="block text-sm mb-1 text-gray-400">Deskripsi</label>
                    <textarea name="description"
                        class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded text-white">{{ old('description', $vehicle->description) }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-cyan-500 hover:bg-cyan-400 px-4 py-2 rounded text-gray-900 font-bold">
                        Update
                    </button>

                    <a href="{{ route('vehicles.index') }}"
                        class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-white">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>