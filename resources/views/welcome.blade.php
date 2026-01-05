<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPUSTAKA - Arsip Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 font-figtree text-gray-800 selection:bg-blue-500 selection:text-white">

    {{-- NAVBAR --}}
    <nav class="absolute top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2 group">
                <div class="bg-blue-600 text-white p-2 rounded-xl group-hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="font-bold text-xl text-gray-900 tracking-tight group-hover:text-blue-600 transition-colors">SIPUSTAKA</span>
            </a>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition-colors">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full bg-gray-900 text-white font-medium hover:bg-black transition-all hover:shadow-lg hover:-translate-y-0.5">Log in</a>
                @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 -z-10 opacity-30">
            <svg width="800" height="800" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="400" cy="400" r="400" fill="url(#paint0_radial_1_2)" fill-opacity="0.4" />
                <defs>
                    <radialGradient id="paint0_radial_1_2" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(400 400) rotate(90) scale(400)">
                        <stop stop-color="#3B82F6" />
                        <stop offset="1" stop-color="white" stop-opacity="0" />
                    </radialGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-bold mb-8 border border-blue-100 shadow-sm animate-fade-in-up">
                <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                Versi 1.0 (PKL Release)
            </div>

            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                Kelola Arsip Buku <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Lebih Cerdas & Rapi</span>
            </h1>

            <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Sistem informasi inventaris modern untuk perpustakaan. Manajemen buku, stok opname, dan pelaporan otomatis dalam satu platform.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 transition-all shadow-xl shadow-blue-600/30 hover:-translate-y-1">
                    Buka Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 transition-all shadow-xl shadow-blue-600/30 hover:-translate-y-1">
                    Mulai Sekarang
                </a>
                {{-- <a href="#" class="px-8 py-4 rounded-xl bg-white text-gray-700 border border-gray-200 font-bold text-lg hover:bg-gray-50 transition-all hover:-translate-y-1">
                            Pelajari Fitur
                        </a> --}}
                @endauth
            </div>
        </div>
    </section>

    {{-- FEATURES GRID --}}
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Feature 1 --}}
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition-colors group">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Inventaris</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Input data buku, klasifikasi DDC, dan lokasi rak dengan mudah. Mendukung input massal via Excel.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-purple-200 transition-colors group">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan Otomatis</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Cetak laporan buku induk, pengadaan, dan stock opname dalam format PDF siap cetak hanya dengan satu klik.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-green-200 transition-colors group">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencatatan Cepat</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Fitur pencarian real-time dan dashboard statistik membantu pustakawan memantau aset secara efisien.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span class="font-bold text-gray-900">SIPUSTAKA</span>
            </div>
            <div class="text-sm text-gray-500">
                &copy; {{ date('Y') }} Project PKL Mahasiswa. Built with Laravel 12 & Tailwind CSS.
            </div>
        </div>
    </footer>

</body>

</html>