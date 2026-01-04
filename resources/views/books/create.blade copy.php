<x-app-layout>
    {{-- Header dengan background gradient halus --}}
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 pb-24 pt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center text-white">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight">Input Buku Baru</h2>
                    <p class="mt-2 text-blue-100 text-sm">Lengkapi data buku secara detail untuk arsip digital yang rapi.</p>
                </div>
                <a href="{{ route('books.index') }}" class="group flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl hover:bg-white/20 transition-all duration-300 border border-white/20 text-sm font-medium">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Dekorasi Background Abstrak --}}
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-400/20 rounded-full blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10 pb-12">
        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- KOLOM KIRI: Identitas Utama (8 Bagian) --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- Card Utama --}}
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Pustaka</h3>
                            </div>

                            <div class="space-y-6">
                                {{-- Judul dengan Icon di dalam --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Buku</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="judul" value="{{ old('judul') }}" class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 placeholder-gray-400 font-medium" placeholder="Masukkan judul buku lengkap..." required autofocus>
                                    </div>
                                    <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Pengarang --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pengarang</label>
                                        <div class="relative group">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <input type="text" name="pengarang" value="{{ old('pengarang') }}" class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300" placeholder="Nama Penulis" required>
                                        </div>
                                        <x-input-error :messages="$errors->get('pengarang')" class="mt-2" />
                                    </div>

                                    {{-- Penerbit --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penerbit</label>
                                        <div class="relative group">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300" placeholder="Nama Penerbit">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Tahun & Tempat --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="block w-full px-4 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300" placeholder="YYYY">
                                        <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Terbit</label>
                                        <input type="text" name="tempat_terbit" value="{{ old('tempat_terbit') }}" class="block w-full px-4 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300" placeholder="Kota">
                                    </div>
                                </div>

                                {{-- Kategori --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Buku</label>
                                    <div class="relative">
                                        <select name="category_id" class="block w-full pl-4 pr-10 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 appearance-none cursor-pointer">
                                            <option value="" disabled selected>Pilih Kategori Klasifikasi DDC</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->kode_ddc }} - {{ $category->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi (Terpisah Card agar lebih clean) --}}
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Tambahan / Sinopsis</label>
                        <textarea name="keterangan" rows="4" class="block w-full px-4 py-3 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 resize-none" placeholder="Tulis catatan tambahan mengenai buku ini...">{{ old('keterangan') }}</textarea>
                    </div>

                </div>

                {{-- KOLOM KANAN: Data Teknis (4 Bagian) --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- Card Data Fisik --}}
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Data Fisik</h3>
                        </div>

                        <div class="space-y-5">
                            {{-- Barcode --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Barcode</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="no_barcode" value="{{ old('no_barcode') }}" class="block w-full pl-10 pr-4 py-3 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300" placeholder="Scan Barcode...">
                                </div>
                                <x-input-error :messages="$errors->get('no_barcode')" class="mt-2" />
                            </div>

                            {{-- No Induk --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">No. Induk Buku</label>
                                <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $suggestedNoInduk) }}" class="block w-full px-4 py-3 bg-indigo-50/50 text-indigo-700 font-mono border-transparent rounded-xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300" required>
                                <x-input-error :messages="$errors->get('no_induk_buku')" class="mt-2" />
                            </div>

                            {{-- Rak --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Lokasi Rak</label>
                                <select name="shelf_id" class="block w-full px-4 py-3 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 cursor-pointer">
                                    <option value="" disabled selected>Pilih Rak</option>
                                    @foreach($shelves as $shelf)
                                    <option value="{{ $shelf->id }}" {{ old('shelf_id') == $shelf->id ? 'selected' : '' }}>
                                        {{ $shelf->nama_rak }} - {{ $shelf->lokasi }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('shelf_id')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Card Stok --}}
                    <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-3xl shadow-xl text-white p-6 relative overflow-hidden">
                        {{-- Dekorasi bulat --}}
                        <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>

                        <h3 class="text-lg font-bold mb-4 relative z-10">Stok Inventaris</h3>

                        <div class="space-y-4 relative z-10">
                            <div class="flex items-center justify-between bg-white/10 p-3 rounded-xl border border-white/10">
                                <span class="text-sm font-medium">Total</span>
                                <input type="number" name="jml_inventaris" value="{{ old('jml_inventaris', 0) }}" class="w-20 bg-transparent border-0 border-b border-white/30 text-right text-white font-bold focus:ring-0 focus:border-white p-0" min="0">
                            </div>
                            <div class="flex items-center justify-between bg-white/10 p-3 rounded-xl border border-white/10">
                                <span class="text-sm font-medium">Di Rak</span>
                                <input type="number" name="jml_rak" value="{{ old('jml_rak', 0) }}" class="w-20 bg-transparent border-0 border-b border-white/30 text-right text-white font-bold focus:ring-0 focus:border-white p-0" min="0">
                            </div>
                            <div class="flex items-center justify-between bg-white/10 p-3 rounded-xl border border-white/10">
                                <span class="text-sm font-medium">Di OPAC</span>
                                <input type="number" name="jml_opac" value="{{ old('jml_opac', 0) }}" class="w-20 bg-transparent border-0 border-b border-white/30 text-right text-white font-bold focus:ring-0 focus:border-white p-0" min="0">
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <button type="submit" class="w-full py-4 bg-gray-900 hover:bg-gray-800 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex justify-center items-center gap-2">
                        <span>Simpan Data Buku</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>

                </div>
            </div>
        </form>
    </div>
</x-app-layout>