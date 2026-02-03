<x-app-layout>
    <div class="bg-slate-50 min-h-screen pb-32">
        {{-- HEADER --}}
        <div class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
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
                    <div></div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    {{-- KOLOM KIRI --}}
                    <div class="lg:col-span-8 space-y-6">
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
                                <div class="relative group">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="block px-4 pb-3 pt-6 w-full text-base text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer" placeholder=" " required autofocus />
                                    <label for="judul" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">Judul Buku Lengkap</label>
                                    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="relative">
                                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang') }}" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer" placeholder=" " required />
                                        <label for="pengarang" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 font-medium">Penulis / Pengarang</label>
                                    </div>
                                    <div class="relative">
                                        <select id="category_id" name="category_id" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all cursor-pointer peer">
                                            <option value="" selected class="text-gray-400">-- Tanpa Kategori--</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->kode_ddc }} - {{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        <label for="category_id" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 font-medium pointer-events-none">Kategori Klasifikasi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                <div class="md:col-span-3 relative">
                                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 left-4">Nama Penerbit</label>
                                </div>
                                <div class="relative">
                                    <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 left-4">Tahun</label>
                                </div>
                                <div class="md:col-span-2 relative">
                                    <input type="text" id="tempat_terbit" name="tempat_terbit" value="{{ old('tempat_terbit') }}" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 left-4">Kota Terbit</label>
                                </div>
                            </div>
                            <div class="relative mt-4">
                                <textarea id="keterangan" name="keterangan" rows="3" class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" ">{{ old('keterangan') }}</textarea>
                                <label class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 left-4">Sinopsis / Keterangan Tambahan</label>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
                            <div class="relative w-full h-64 rounded-xl overflow-hidden group cursor-pointer border-2 border-dashed border-gray-300 hover:border-blue-400 transition-colors bg-gray-50">
                                <img id="cover-preview" class="absolute inset-0 w-full h-full object-cover hidden z-10" />
                                <div id="cover-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                                    <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-800">Cover Buku</h4>
                                    <p class="text-xs text-gray-400 mt-1">Klik atau Drop gambar disini</p>
                                </div>
                                <input type="file" name="cover" id="cover" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(event)">
                            </div>
                        </div>

                        <div class="bg-gray-900 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                            <h3 class="font-bold text-white uppercase tracking-wider text-xs mb-6 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Aset Fisik
                            </h3>
                            <div class="space-y-5 relative z-10">
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Barcode</label>
                                    <div class="flex">
                                        <input type="text" id="no_barcode" name="no_barcode" value="{{ old('no_barcode') }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-l-lg text-white text-sm font-mono" placeholder="||||||||||||" />
                                        <button type="button" onclick="generateRandomBarcode()" class="bg-gray-700 hover:bg-gray-600 px-3 py-2 rounded-r-lg border border-l-0 border-gray-700 transition-colors">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Lokasi Rak</label>
                                    <select name="shelf_id" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white text-sm">
                                        <option value="" selected>-- Belum Masuk Rak --</option>
                                        @foreach($shelves as $shelf)
                                        <option value="{{ $shelf->id }}" {{ old('shelf_id') == $shelf->id ? 'selected' : '' }}>{{ $shelf->nama_rak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="pt-4 border-t border-gray-800">
                                    <label class="text-[10px] uppercase font-bold text-gray-500 mb-1 block">No. Induk</label>
                                    <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $suggestedNoInduk) }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white text-sm font-mono" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h3 class="font-bold text-gray-800 uppercase tracking-wider text-xs mb-4 flex items-center gap-2">Manajemen Stok</h3>
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">Total</label>
                                    <input type="number" id="jml_inventaris" name="jml_inventaris" value="{{ old('jml_inventaris', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">Rak</label>
                                    <input type="number" id="jml_rak" name="jml_rak" value="{{ old('jml_rak', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase text-center block mb-1">OPAC</label>
                                    <input type="number" id="jml_opac" name="jml_opac" value="{{ old('jml_opac', 0) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold text-gray-800 text-lg py-2" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-sm py-4">
                    <div class="max-w-7xl mx-auto px-4 flex justify-end gap-4">
                        <a href="{{ route('books.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 font-bold">Batal</a>
                        <button type="submit" class="px-8 py-2.5 rounded-xl bg-gray-900 text-white font-bold shadow-lg">Simpan Arsip</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputTotal = document.getElementById('jml_inventaris');
            const inputRak = document.getElementById('jml_rak');
            const inputOpac = document.getElementById('jml_opac');

            if (inputTotal) {
                inputTotal.addEventListener('input', function() {
                    const value = this.value;

                    // Logika Perbaikan: 
                    // Hanya isi otomatis jika nilai Rak atau OPAC masih 0 atau kosong.
                    // Ini mencegah nilai yang sudah kita ubah manual tertimpa kembali.
                    if (inputRak.value == 0 || inputRak.value == "") {
                        inputRak.value = value;
                    }
                    if (inputOpac.value == 0 || inputOpac.value == "") {
                        inputOpac.value = value;
                    }
                });
            }
        });

        // Fungsi preview dan barcode tetap sama
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById('cover-preview');
            const placeholder = document.getElementById('cover-placeholder');
            reader.onload = function() {
                if (reader.readyState == 2) {
                    imageField.src = reader.result;
                    imageField.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            }
            if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
        }

        function generateRandomBarcode() {
            const date = new Date();
            const barcode = `${date.getFullYear()}${String(date.getMonth() + 1).padStart(2, '0')}${String(date.getDate()).padStart(2, '0')}${Math.floor(1000 + Math.random() * 9000)}`;
            const inputBarcode = document.getElementById('no_barcode');
            if (inputBarcode) inputBarcode.value = barcode;
        }
    </script>
</x-app-layout>