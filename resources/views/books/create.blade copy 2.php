<x-app-layout>
    {{-- Background Abu-abu terang agar konten pop-up --}}
    <div class="bg-gray-50 min-h-screen pb-24">

        {{-- Header Minimalis --}}
        <div class="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div class="bg-black text-white p-1.5 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 tracking-tight">Input Buku</h2>
                    </div>
                    <a href="{{ route('books.index') }}" class="text-sm font-medium text-gray-500 hover:text-black transition-colors">
                        Batal & Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                {{-- Main Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 min-h-[600px]">

                        {{-- KOLOM KIRI: Bibliografi (Lebar 2) --}}
                        <div class="lg:col-span-2 p-8 border-b lg:border-b-0 lg:border-r border-gray-100">
                            <div class="mb-8">
                                <h3 class="text-base font-semibold text-gray-900 uppercase tracking-wider mb-1">Data Bibliografi</h3>
                                <p class="text-sm text-gray-500">Informasi utama mengenai identitas buku.</p>
                            </div>

                            <div class="space-y-6">
                                {{-- Floating Label Input Component: Judul --}}
                                <div class="relative">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                        placeholder=" " required autofocus />
                                    <label for="judul"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Judul Buku Lengkap
                                    </label>
                                    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Pengarang --}}
                                    <div class="relative">
                                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang') }}"
                                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                            placeholder=" " required />
                                        <label for="pengarang"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                            Nama Pengarang
                                        </label>
                                    </div>

                                    {{-- Penerbit --}}
                                    <div class="relative">
                                        <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}"
                                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                            placeholder=" " />
                                        <label for="penerbit"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                            Nama Penerbit
                                        </label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Tahun --}}
                                    <div class="relative">
                                        <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                            placeholder=" " />
                                        <label for="tahun_terbit"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                            Tahun Terbit (YYYY)
                                        </label>
                                        <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-1" />
                                    </div>

                                    {{-- Tempat --}}
                                    <div class="relative">
                                        <input type="text" id="tempat_terbit" name="tempat_terbit" value="{{ old('tempat_terbit') }}"
                                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                            placeholder=" " />
                                        <label for="tempat_terbit"
                                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                            Kota Terbit
                                        </label>
                                    </div>
                                </div>

                                {{-- Kategori (Standard Select for Usability) --}}
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori Klasifikasi</label>
                                    <select name="category_id" class="block w-full px-3 py-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-black focus:border-black">
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->kode_ddc }} - {{ $category->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                                </div>

                                {{-- Keterangan / Sinopsis --}}
                                <div class="relative">
                                    <textarea id="keterangan" name="keterangan" rows="4"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                                        placeholder=" ">{{ old('keterangan') }}</textarea>
                                    <label for="keterangan"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-6 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Keterangan / Sinopsis Buku
                                    </label>
                                </div>

                            </div>
                        </div>

                        {{-- KOLOM KANAN: Teknis (Lebar 1) --}}
                        <div class="bg-gray-50/50 p-8 space-y-8">

                            {{-- Section Inventaris --}}
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 uppercase tracking-wider mb-1">Inventaris</h3>
                                <p class="text-sm text-gray-500 mb-6">Kelola kode dan lokasi fisik.</p>

                                <div class="space-y-5">
                                    {{-- Kode Barcode --}}
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="no_barcode" value="{{ old('no_barcode') }}"
                                            class="block w-full pl-10 pr-3 py-3 text-sm border-gray-300 rounded-lg focus:ring-black focus:border-black placeholder-gray-400"
                                            placeholder="Scan Barcode Disini" />
                                    </div>

                                    {{-- No Induk (Readonly look) --}}
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Nomor Induk</label>
                                        <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $suggestedNoInduk) }}"
                                            class="block w-full py-2 px-3 bg-white border border-gray-300 rounded-md text-sm font-mono text-gray-600 focus:ring-black focus:border-black" />
                                        <x-input-error :messages="$errors->get('no_induk_buku')" class="mt-1" />
                                    </div>

                                    {{-- Rak --}}
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Lokasi Rak</label>
                                        <select name="shelf_id" class="block w-full py-2 px-3 text-sm bg-white border border-gray-300 rounded-md focus:ring-black focus:border-black">
                                            <option value="" disabled selected>Pilih Rak...</option>
                                            @foreach($shelves as $shelf)
                                            <option value="{{ $shelf->id }}" {{ old('shelf_id') == $shelf->id ? 'selected' : '' }}>
                                                {{ $shelf->nama_rak }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('shelf_id')" class="mt-1" />
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-200">

                            {{-- Section Stok --}}
                            <div>
                                <h3 class="text-base font-semibold text-gray-900 uppercase tracking-wider mb-4">Jumlah Stok</h3>

                                <div class="grid grid-cols-3 gap-2">
                                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Total</label>
                                        <input type="number" name="jml_inventaris" value="{{ old('jml_inventaris', 0) }}" class="w-full text-center border-none p-0 focus:ring-0 font-bold text-lg text-gray-800" min="0">
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">Rak</label>
                                        <input type="number" name="jml_rak" value="{{ old('jml_rak', 0) }}" class="w-full text-center border-none p-0 focus:ring-0 font-bold text-lg text-gray-800" min="0">
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                                        <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">OPAC</label>
                                        <input type="number" name="jml_opac" value="{{ old('jml_opac', 0) }}" class="w-full text-center border-none p-0 focus:ring-0 font-bold text-lg text-gray-800" min="0">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Action Bar (Sticky Bottom) --}}
                <div class="fixed bottom-0 left-0 lg:left-64 right-0 bg-white border-t border-gray-200 p-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-20 flex justify-between items-center px-8">
                    <div class="text-sm text-gray-500 hidden md:block">
                        Pastikan data yang diinput sudah sesuai dengan fisik buku.
                    </div>
                    <div class="flex gap-4 w-full md:w-auto">
                        <a href="{{ route('books.index') }}" class="flex-1 md:flex-none px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 text-center">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 md:flex-none px-8 py-2.5 rounded-lg bg-black text-white font-bold hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all text-center">
                            Simpan Buku
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>