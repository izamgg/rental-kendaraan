<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Logo Tab Browser -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-rental.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahan Alpine.js untuk fitur geser/slider gambar -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #030712;
        }

        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, rgba(0,0,0,0) 70%);
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-950 text-gray-200 antialiased relative min-h-screen overflow-x-hidden">

    <div class="ambient-glow"></div>

    <header class="sticky top-0 z-50 bg-gray-950/70 backdrop-blur-md border-b border-gray-800/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-rental.png') }}" alt="Logo RENTALKU" class="w-12 h-12 object-contain">
                    <div class="leading-tight">
                        <h1 class="text-2xl font-bold text-cyan-400 tracking-wide">RENTALKU</h1>
                        <p class="text-xs text-gray-400">Rental Kendaraan</p>
                    </div>
                </a>

                <nav class="hidden md:flex gap-8 font-medium">
                    <a href="#" class="text-gray-300 hover:text-cyan-400 transition">Home</a>
                    <a href="#armada" class="text-gray-300 hover:text-cyan-400 transition">Armada</a>
                    <a href="#about" class="text-gray-300 hover:text-cyan-400 transition">About</a>
                    <a href="#contact" class="text-gray-300 hover:text-cyan-400 transition">Contact</a>
                </nav>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-cyan-500 hover:bg-cyan-400 text-gray-950 font-semibold px-4 py-2 rounded-lg shadow-lg shadow-cyan-500/20 transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-cyan-400 font-medium transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="border border-gray-700 hover:border-cyan-500 text-gray-300 hover:text-cyan-400 px-4 py-2 rounded-lg transition duration-300">
                            Register
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 relative">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center gap-2 bg-cyan-950/50 border border-cyan-800/60 text-cyan-400 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    Rental Kendaraan Terpercaya
                </span>
                <h1 class="text-5xl md:text-6xl font-bold mt-6 leading-tight tracking-tight text-white">
                    Sewa Kendaraan Dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-teal-200">Mudah, Cepat & Aman</span>
                </h1>
                <p class="mt-6 text-gray-400 text-lg leading-relaxed">
                    Tersedia berbagai pilihan kendaraan mulai dari sepeda motor, mobil, pickup hingga truck dengan harga terjangkau dan pelayanan terbaik.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" class="bg-cyan-500 hover:bg-cyan-400 text-gray-950 px-6 py-3 rounded-lg font-bold shadow-lg shadow-cyan-500/20 hover:shadow-cyan-400/40 transition duration-300">
                        Pesan Sekarang
                    </a>
                    <a href="#about" class="bg-gray-900/40 border border-gray-800 hover:border-gray-700 hover:bg-gray-900/80 text-gray-300 px-6 py-3 rounded-lg font-medium transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                <div class="relative bg-gray-900 rounded-3xl overflow-hidden border border-gray-800">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70" alt="Rental Mobil" class="w-full h-auto object-cover opacity-80 group-hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- Armada Section -->
    <section id="armada" class="bg-gray-950/40 border-t border-b border-gray-900 py-20 relative">
        <div class="absolute right-0 bottom-0 w-80 h-80 bg-cyan-950/10 blur-3xl pointer-events-none rounded-full"></div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white tracking-tight">Armada Kami</h2>
                <p class="text-gray-400 mt-3 max-w-xl mx-auto">
                    Pilihan kendaraan prima yang siap menemani dan mensukseskan segala kebutuhan perjalanan Anda.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Motor -->
                <div class="bg-gradient-to-b from-gray-900/60 to-gray-950/80 border border-gray-800/80 hover:border-cyan-500/50 p-6 rounded-2xl text-center group transition-all duration-300 hover:-translate-y-1">
                    <div class="text-5xl bg-gray-900 w-16 h-16 flex items-center justify-center rounded-2xl mx-auto border border-gray-800 group-hover:border-cyan-500/30 transition">🏍️</div>
                    <h3 class="font-bold text-xl mt-5 text-white group-hover:text-cyan-400 transition">Sepeda Motor</h3>
                    <p class="text-gray-400 mt-2 text-sm leading-relaxed">Praktis dan hemat untuk aktivitas harian padat Anda.</p>
                </div>
                <!-- Mobil -->
                <div class="bg-gradient-to-b from-gray-900/60 to-gray-950/80 border border-gray-800/80 hover:border-cyan-500/50 p-6 rounded-2xl text-center group transition-all duration-300 hover:-translate-y-1">
                    <div class="text-5xl bg-gray-900 w-16 h-16 flex items-center justify-center rounded-2xl mx-auto border border-gray-800 group-hover:border-cyan-500/30 transition">🚗</div>
                    <h3 class="font-bold text-xl mt-5 text-white group-hover:text-cyan-400 transition">Mobil</h3>
                    <p class="text-gray-400 mt-2 text-sm leading-relaxed">Sangat nyaman untuk perjalanan keluarga maupun bisnis.</p>
                </div>
                <!-- Pickup -->
                <div class="bg-gradient-to-b from-gray-900/60 to-gray-950/80 border border-gray-800/80 hover:border-cyan-500/50 p-6 rounded-2xl text-center group transition-all duration-300 hover:-translate-y-1">
                    <div class="text-5xl bg-gray-900 w-16 h-16 flex items-center justify-center rounded-2xl mx-auto border border-gray-800 group-hover:border-cyan-500/30 transition">🛻</div>
                    <h3 class="font-bold text-xl mt-5 text-white group-hover:text-cyan-400 transition">Pickup</h3>
                    <p class="text-gray-400 mt-2 text-sm leading-relaxed">Cocok tangguh untuk segala kebutuhan pengangkutan barang.</p>
                </div>
                <!-- Truck -->
                <div class="bg-gradient-to-b from-gray-900/60 to-gray-950/80 border border-gray-800/80 hover:border-cyan-500/50 p-6 rounded-2xl text-center group transition-all duration-300 hover:-translate-y-1">
                    <div class="text-5xl bg-gray-900 w-16 h-16 flex items-center justify-center rounded-2xl mx-auto border border-gray-800 group-hover:border-cyan-500/30 transition">🚚</div>
                    <h3 class="font-bold text-xl mt-5 text-white group-hover:text-cyan-400 transition">Truck</h3>
                    <p class="text-gray-400 mt-2 text-sm leading-relaxed">Solusi mutakhir logistik & distribusi skala besar terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="about" class="py-20 bg-gray-950/20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                
                <!-- Sisi Kiri: Slider Foto -->
                <div class="relative group" x-data="{ 
                    activeSlide: 0, 
                    images: [
                        'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?q=80&w=600&auto=format&fit=crop'
                    ] 
                }">
                    <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-3xl blur opacity-15 group-hover:opacity-25 transition duration-1000"></div>
                    
                    <div class="relative bg-gray-900 rounded-3xl overflow-hidden border border-gray-800 aspect-[4/3]">
                        <template x-for="(img, index) in images" :key="index">
                            <img :src="img" 
                                 alt="Foto Tentang Kami" 
                                 class="absolute inset-0 w-full h-full object-cover opacity-80 transition-all duration-500 ease-in-out transform"
                                 :class="activeSlide === index ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-95 z-0'">
                        </template>

                        <button @click="activeSlide = activeSlide === 0 ? images.length - 1 : activeSlide - 1" 
                                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-gray-950/60 hover:bg-cyan-500 hover:text-gray-950 border border-gray-800 p-2.5 rounded-full transition duration-300 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <button @click="activeSlide = activeSlide === images.length - 1 ? 0 : activeSlide + 1" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-gray-950/60 hover:bg-cyan-500 hover:text-gray-950 border border-gray-800 p-2.5 rounded-full transition duration-300 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                        <template x-for="(img, index) in images" :key="index">
                            <button @click="activeSlide = index" 
                                    class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                    :class="activeSlide === index ? 'bg-cyan-400 w-6' : 'bg-gray-600'"></button>
                        </template>
                    </div>
                </div>

                <!-- Sisi Kanan: Teks Penjelasan -->
                <div class="text-left">
                    <h2 class="text-4xl font-bold mb-6 text-white tracking-tight">Tentang Kami</h2>
                    <p class="text-gray-400 leading-relaxed text-lg mb-4">
                        Kami menyediakan layanan rental kendaraan yang aman, nyaman dan terpercaya. Seluruh armada selalu dalam kondisi prima serta siap digunakan untuk kebutuhan perjalanan pribadi, bisnis maupun logistik.
                    </p>
                    <p class="text-gray-400 leading-relaxed text-lg">
                        Dengan pelayanan prima 24/7 dan sistem pemesanan yang mudah, kami berkomitmen untuk memberikan pengalaman berkendara terbaik bagi Anda di setiap perjalanan.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-gray-950 border-t border-gray-900 py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white tracking-tight">Hubungi Kami</h2>
                <p class="text-gray-400 mt-3 max-w-xl mx-auto">
                    Punya pertanyaan atau ingin melakukan pemesanan langsung? Tim kami siap membantu Anda 24/7.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-stretch">
                <!-- Info Kontak (Kiri) -->
                <div class="bg-gradient-to-b from-gray-900/50 to-gray-950/50 border border-gray-800 rounded-3xl p-8 flex flex-col justify-between space-y-6">
                    <div>
                        <h3 class="text-xl font-bold text-cyan-400 mb-2">Informasi Kontak</h3>
                        <p class="text-gray-400 text-sm mb-6">Silakan hubungi kami melalui salah satu saluran di bawah ini.</p>
                        
                        <div class="space-y-4">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/6287783345597" target="_blank" class="flex items-center gap-4 p-4 rounded-xl bg-gray-900/50 border border-gray-800/80 hover:border-emerald-500/50 hover:bg-gray-900 transition-all group">
                                <div class="w-12 h-12 rounded-xl bg-emerald-950/50 border border-emerald-800/40 flex items-center justify-center text-2xl group-hover:scale-105 transition">
                                    🟢
                                </div>
                                <div class="text-left">
                                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">WhatsApp</p>
                                    <p class="text-base text-gray-200 group-hover:text-emerald-400 transition font-medium">+62 877-8334-5597</p>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:info@rentalku.com" class="flex items-center gap-4 p-4 rounded-xl bg-gray-900/50 border border-gray-800/80 hover:border-cyan-500/50 hover:bg-gray-900 transition-all group">
                                <div class="w-12 h-12 rounded-xl bg-cyan-950/50 border border-cyan-800/40 flex items-center justify-center text-2xl group-hover:scale-105 transition">
                                    ✉️
                                </div>
                                <div class="text-left">
                                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Email Resmi</p>
                                    <p class="text-base text-gray-200 group-hover:text-cyan-400 transition font-medium">info@rentalku.com</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="pt-6 border-t border-gray-900/80 text-left">
                        <p class="text-sm text-gray-400 font-medium">Jam Operasional:</p>
                        <p class="text-xs text-gray-500 mt-1">Setiap Hari: 07:00 - 22:00 WIB (Pemesanan Web 24 Jam)</p>
                    </div>
                </div>

                <!-- Google Maps (Kanan) -->
                <div class="w-full h-[350px] md:h-auto min-h-[350px] bg-gray-900 rounded-3xl overflow-hidden border border-gray-800 relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-3xl blur opacity-10 group-hover:opacity-20 transition duration-1000 pointer-events-none"></div>
                    
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d989.9791186878558!2d113.86666392848976!3d-7.019103999559572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDEnMDguOCJTIDExM8KwNTInMDIuMyJF!5e0!3m2!1sid!2sid!4v1782832841844!5m2!1sid!2sid" 
                        class="w-full h-full border-0 opacity-80 group-hover:opacity-100 transition duration-300" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

    <!-- ==================== Tambahan: Bagian Kredit / Footer Profesional ==================== -->
    <footer class="bg-gray-950 border-t border-gray-900 text-gray-400 py-12 relative overflow-hidden">
        <!-- Efek Glow Tambahan di Pojok Kiri Bawah -->
        <div class="absolute left-0 bottom-0 w-64 h-64 bg-cyan-950/10 blur-3xl pointer-events-none rounded-full"></div>
        
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-gray-900">
                
                <!-- Kolom 1: Branding -->
                <div class="md:col-span-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-rental.png') }}" alt="Logo RENTALKU" class="w-10 h-10 object-contain opacity-90">
                        <span class="text-xl font-bold text-white tracking-wider">RENTALKU</span>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-500">
                        Solusi terbaik persewaan kendaraan prima terpercaya, aman, dan berkelas untuk menunjang segala mobilitas perjalanan Anda.
                    </p>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-cyan-400 transition-colors">Beranda</a></li>
                        <li><a href="#armada" class="hover:text-cyan-400 transition-colors">Armada Pilihan</a></li>
                        <li><a href="#about" class="hover:text-cyan-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#contact" class="hover:text-cyan-400 transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kebijakan & Dokumen -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Layanan</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-cyan-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-cyan-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-cyan-400 transition-colors">Cara Pemesanan</a></li>
                        <li><a href="#" class="hover:text-cyan-400 transition-colors">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Jejaring Sosial / Newsletter Ringan -->
                <div class="space-y-4">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Ikuti Kami</h4>
                    <p class="text-sm text-gray-500">Dapatkan info promo kendaraan terbaru melalui media sosial kami.</p>
                    <div class="flex gap-3 pt-1">
                        <!-- Facebook Mock-up Icon -->
                        <a href="#" class="w-9 h-9 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center hover:border-cyan-500/50 hover:text-cyan-400 transition group">
                            <span class="text-xs font-semibold group-hover:scale-105 transition">FB</span>
                        </a>
                        <!-- Instagram Mock-up Icon -->
                        <a href="#" class="w-9 h-9 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center hover:border-cyan-500/50 hover:text-cyan-400 transition group">
                            <span class="text-xs font-semibold group-hover:scale-105 transition">IG</span>
                        </a>
                        <!-- TikTok Mock-up Icon -->
                        <a href="#" class="w-9 h-9 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center hover:border-cyan-500/50 hover:text-cyan-400 transition group">
                            <span class="text-xs font-semibold group-hover:scale-105 transition">TK</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bagian Hak Cipta & Kredit Tech Stack -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-600">
                <div>
                    &copy; 2026 <span class="text-gray-500 font-medium">RENTALKU</span>. Seluruh Hak Cipta Dilindungi.
                </div>
                <div class="flex items-center gap-1.5 bg-gray-900/60 border border-gray-900 px-3 py-1.5 rounded-full">
                    <span>Dikembangkan dengan</span>
                    <span class="text-cyan-500 font-medium">Laravel</span>
                    <span>&amp;</span>
                    <span class="text-cyan-500 font-medium">Tailwind CSS</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>