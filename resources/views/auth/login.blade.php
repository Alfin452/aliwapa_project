<x-guest-layout>
    {{-- Container Utama: Flex Split Screen (Full Height) --}}
    <div class="min-h-screen flex bg-white">

        {{-- BAGIAN KIRI: ILUSTRASI (Width: 60%) --}}
        {{-- Area ini untuk branding visual yang kuat tapi tenang --}}
        <div class="hidden lg:flex lg:w-[60%] relative bg-slate-900 overflow-hidden">

            {{-- Gambar Latar (Perpustakaan Modern / Rak Buku) --}}
            {{-- Menggunakan efek grayscale sedikit agar tidak mencolok mata --}}
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=2428&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay"
                alt="Library Shelves">

            {{-- Gradient Overlay (Biru Tua Elegant) --}}
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 to-slate-900/95"></div>

            {{-- Konten Branding (Tengah) --}}
            <div class="relative z-10 w-full h-full flex flex-col justify-center px-16 text-white">

                {{-- Ikon Besar --}}
                <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mb-8 border border-white/10 shadow-2xl">
                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>

                <h1 class="text-5xl font-bold tracking-tight mb-6 leading-tight">
                    Sistem Informasi <br>
                    <span class="text-blue-300">Arsip Perpustakaan</span>
                </h1>

                <p class="text-lg text-slate-300 max-w-xl leading-relaxed font-light">
                    Kelola ribuan koleksi buku, pantau ketersediaan stok, dan cetak laporan inventaris secara real-time dalam satu platform terintegrasi.
                </p>

                {{-- Indikator Fitur --}}
                <div class="mt-12 flex gap-8">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                        <span class="text-sm font-medium text-slate-300">Manajemen Aset</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                        <span class="text-sm font-medium text-slate-300">Sirkulasi Digital</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                        <span class="text-sm font-medium text-slate-300">Laporan Otomatis</span>
                    </div>
                </div>
            </div>

            {{-- Copyright Kecil di Bawah --}}
            <div class="absolute bottom-8 left-16 text-xs text-slate-500 font-mono">
                SIPUSTAKA v1.0 &copy; {{ date('Y') }}
            </div>
        </div>

        {{-- BAGIAN KANAN: FORM LOGIN (Width: 40%) --}}
        <div class="w-full lg:w-[40%] flex flex-col justify-center items-center p-8 bg-white">

            <div class="w-full max-w-[380px]">

                {{-- Header Login --}}
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-500 mt-2">Silakan login untuk mengakses dashboard.</p>
                </div>

                {{-- Alert Status --}}
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="block w-full px-4 py-3.5 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:bg-white focus:border-blue-600 focus:ring-blue-600 transition-all placeholder-slate-400 sm:text-sm"
                            placeholder="admin@perpustakaan.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full px-4 py-3.5 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:bg-white focus:border-blue-600 focus:ring-blue-600 transition-all placeholder-slate-400 sm:text-sm"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-600 cursor-pointer" name="remember">
                        <label for="remember_me" class="ms-2 text-sm text-slate-600 cursor-pointer select-none">Ingat saya</label>
                    </div>

                    {{-- Tombol Login --}}
                    <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/20 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all transform hover:-translate-y-0.5">
                        MASUK KE DASHBOARD
                    </button>
                </form>

                {{-- Footer Login --}}
                <div class="mt-12 text-center border-t border-slate-100 pt-6">
                    <p class="text-xs text-slate-400">
                        Masalah saat login? Hubungi <a href="#" class="text-blue-600 hover:underline">Tim IT Support</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>