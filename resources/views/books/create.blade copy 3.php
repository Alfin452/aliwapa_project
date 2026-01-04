<x-app-layout>
    {{-- Background Abu-abu Slate yang lebih profesional --}}
    <div class="bg-slate-50 min-h-screen pb-32">

        {{-- Header Sticky dengan Glassmorphism effect --}}
        <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 tracking-tight leading-none">Input Buku Baru</h2>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Sistem Arsip Digital Perpustakaan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wider">Mode Input Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    {{-- KOLOM KIRI: EDITOR DATA (8 Kolom) --}}
                    <div class="lg:col-span-8 space-y-6">

                        {{-- SECTION 1: Identitas Utama --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </span>
                                <h3 class="font-bold text-gray-800 text-lg">Bibliografi Utama</h3>
                            </div>

                            <div class="space-y-8">
                                {{-- Judul (Floating) --}}
                                <div class="relative group">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                        class="block px-4 pb-3 pt-6 w-full text-base text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer"
                                        placeholder=" " required autofocus />
                                    <label for="judul"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                        Judul Buku Lengkap
                                    </label>
                                    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Pengarang --}}
                                    <div class="relative">
                                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang') }}"
                                            class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer"
                                            placeholder=" " required />
                                        <label for="pengarang"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                            Penulis / Pengarang
                                        </label>
                                    </div>

                                    {{-- Kategori (Custom Select Style) --}}
                                    <div class="relative">
                                        <select id="category_id" name="category_id"
                                            class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all cursor-pointer">
                                            <option value="" disabled selected></option> {{-- Empty for placeholder effect --}}
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->kode_ddc }} - {{ $category->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="category_id"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 font-medium pointer-events-none">
                                            Kategori Klasifikasi
                                        </label>
                                        {{-- Custom Chevron --}}
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECTION 2: Detail Publikasi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </span>
                                <h3 class="font-bold text-gray-800 text-lg">Publikasi</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                {{-- Penerbit --}}
                                <div class="md:col-span-3 relative">
                                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}"
                                        class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 focus:bg-white transition-all peer"
                                        placeholder=" " />
                                    <label for="penerbit"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                        Nama Penerbit
                                    </label>
                                </div>

                                {{-- Tahun --}}
                                <div class="relative">
                                    <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                        class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 focus:bg-white transition-all peer"
                                        placeholder=" " />
                                    <label for="tahun_terbit"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                        Tahun
                                    </label>
                                </div>

                                {{-- Tempat --}}
                                <div class="md:col-span-2 relative">
                                    <input type="text" id="tempat_terbit" name="tempat_terbit" value="{{ old('tempat_terbit') }}"
                                        class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 focus:bg-white transition-all peer"
                                        placeholder=" " />
                                    <label for="tempat_terbit"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                        Kota Terbit
                                    </label>
                                </div>
                            </div>

                            {{-- Keterangan Field --}}
                            <div class="relative mt-4">
                                <textarea id="keterangan" name="keterangan" rows="3"
                                    class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 focus:bg-white transition-all peer"
                                    placeholder=" ">{{ old('keterangan') }}</textarea>
                                <label for="keterangan"
                                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">
                                    Sinopsis / Keterangan Tambahan
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: ASSET MANAGER (4 Kolom) --}}
                    <div class="lg:col-span-4 space-y-6">

                        {{-- CARD: Cover Buku (Mockup Visual) --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col items-center justify-center text-center group cursor-pointer hover:border-blue-400 transition-colors border-dashed border-2 h-64">
                            <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-800">Cover Buku</h4>
                            <p class="text-xs text-gray-400 mt-1 px-4">Drag & drop gambar sampul di sini atau klik untuk upload.</p>
                        </div>

                        {{-- CARD: Identitas Fisik --}}
                        <div class="bg-gray-900 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>

                            <h3 class="font-bold text-white uppercase tracking-wider text-xs mb-6 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Aset Fisik
                            </h3>

                            <div class="space-y-5 relative z-10">
                                {{-- Barcode Scanner Style --}}
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Scan Barcode</label>
                                    <div class="flex">
                                        <input type="text" name="no_barcode" value="{{ old('no_barcode') }}"
                                            class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-l-lg text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 text-sm font-mono"
                                            placeholder="||||||||||||" />
                                        <button type="button" class="bg-gray-700 hover:bg-gray-600 px-3 py-2 rounded-r-lg border border-l-0 border-gray-700 transition-colors">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Rak Dropdown --}}
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Lokasi Rak</label>
                                    <select name="shelf_id" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="" disabled selected class="text-gray-500">Pilih Rak...</option>
                                        @foreach($shelves as $shelf)
                                        <option value="{{ $shelf->id }}" {{ old('shelf_id') == $shelf->id ? 'selected' : '' }}>
                                            {{ $shelf->nama_rak }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- No Induk Readonly --}}
                                <div class="pt-4 border-t border-gray-800">
                                    <label class="text-[10px] uppercase font-bold text-gray-500 mb-1 block">No. Induk System</label>
                                    <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $suggestedNoInduk) }}"
                                        class="block w-full bg-transparent border-none text-gray-400 font-mono text-sm p-0 focus:ring-0" readonly />
                                </div>
                            </div>
                        </div>

                        {{-- CARD: Manajemen Stok --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h3 class="font-bold text-gray-800 uppercase tracking-wider text-xs mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Manajemen Stok
                            </h3>

                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">Total</label>
                                    <input type="number" name="jml_inventaris" value="{{ old('jml_inventaris', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg focus:ring-black focus:border-black font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">Rak</label>
                                    <input type="number" name="jml_rak" value="{{ old('jml_rak', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg focus:ring-black focus:border-black font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">OPAC</label>
                                    <input type="number" name="jml_opac" value="{{ old('jml_opac', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg focus:ring-black focus:border-black font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- FOOTER ACTION BAR (Floating Bottom) --}}
                <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="flex justify-between items-center">
                            <div class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Sistem siap menyimpan data baru</span>
                            </div>
                            <div class="flex gap-4 w-full md:w-auto">
                                <a href="{{ route('books.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors flex-1 md:flex-none text-center">
                                    Batal
                                </a>
                                <button type="submit" class="px-8 py-2.5 rounded-xl bg-gray-900 text-white font-bold hover:bg-black shadow-lg hover:shadow-gray-900/20 transition-all flex-1 md:flex-none flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Simpan Arsip
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>