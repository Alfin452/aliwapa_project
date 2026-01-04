<x-app-layout>
    <div class="bg-slate-50 min-h-screen pb-32">

        {{-- HEADER EDIT MODE --}}
        <div class="sticky top-0 z-40 bg-amber-50 border-b border-amber-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 tracking-tight leading-none">Edit Data Buku</h2>
                            <p class="text-xs text-amber-700 mt-1 font-medium">Anda sedang mengubah data arsip.</p>
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- PENTING: Method PUT untuk Update --}}

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
                                {{-- Judul --}}
                                <div class="relative group">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul', $book->judul) }}"
                                        class="block px-4 pb-3 pt-6 w-full text-base text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer"
                                        placeholder=" " required />
                                    <label for="judul"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 font-medium">Judul Buku</label>
                                    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Pengarang --}}
                                    <div class="relative">
                                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}"
                                            class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all peer"
                                            placeholder=" " required />
                                        <label for="pengarang" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 font-medium">Penulis</label>
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="relative">
                                        <select id="category_id" name="category_id"
                                            class="block px-4 pb-3 pt-6 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 focus:bg-white transition-all cursor-pointer peer">

                                            <option value="" {{ $book->category_id == null ? 'selected' : '' }} class="text-gray-400">-- Tanpa Kategori --</option>

                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->kode_ddc }} - {{ $category->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="category_id" class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 z-10 left-4 font-medium">Kategori Klasifikasi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Publikasi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-bold text-gray-800 text-lg">Publikasi</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="md:col-span-3 relative">
                                    <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Penerbit</label>
                                </div>
                                <div class="relative">
                                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Tahun</label>
                                </div>
                                <div class="md:col-span-2 relative">
                                    <input type="text" name="tempat_terbit" value="{{ old('tempat_terbit', $book->tempat_terbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer placeholder-transparent" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Kota</label>
                                </div>
                            </div>
                            <textarea name="keterangan" rows="3" class="block w-full px-4 py-3 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 text-sm" placeholder="Keterangan tambahan...">{{ old('keterangan', $book->keterangan) }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    {{-- KOLOM KANAN (SIDEBAR) --}}
                    <div class="lg:col-span-4 space-y-6">

                        {{-- 1. COVER BUKU (PREVIEW + UPLOAD) --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
                            <div class="relative w-full h-64 rounded-xl overflow-hidden group cursor-pointer border-2 border-dashed border-gray-300 hover:border-amber-400 transition-colors bg-gray-50">
                                {{-- Preview: Prioritaskan Gambar Baru -> Gambar Lama -> Placeholder --}}
                                <img id="cover-preview"
                                    src="{{ $book->cover ? asset('storage/'.$book->cover) : '' }}"
                                    class="{{ $book->cover ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-10" />

                                <div id="cover-placeholder" class="{{ $book->cover ? 'hidden' : '' }} absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                                    <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-800">Ganti Cover</h4>
                                    <p class="text-xs text-gray-400 mt-1">Klik untuk upload baru</p>
                                </div>

                                <input type="file" name="cover" id="cover" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(event)">
                            </div>
                            <x-input-error :messages="$errors->get('cover')" class="mt-1 px-2" />
                        </div>

                        {{-- 2. ASET FISIK (HITAM) --}}
                        <div class="bg-gray-900 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                            {{-- Dekorasi Glow --}}
                            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>

                            <h3 class="font-bold uppercase text-xs mb-6 flex items-center gap-2 relative z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Aset Fisik
                            </h3>

                            <div class="space-y-5 relative z-10">
                                {{-- Barcode --}}
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Barcode</label>
                                    <input type="text" name="no_barcode" value="{{ old('no_barcode', $book->no_barcode) }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white font-mono text-sm focus:border-amber-500 focus:ring-amber-500" />
                                    <x-input-error :messages="$errors->get('no_barcode')" class="mt-1" />
                                </div>

                                {{-- RAK DROPDOWN (PASTIKAN INI ADA) --}}
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-gray-400 mb-1 block">Lokasi Rak</label>
                                    <select name="shelf_id" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white text-sm focus:ring-amber-500 focus:border-amber-500 cursor-pointer">

                                        <option value="" {{ $book->shelf_id == null ? 'selected' : '' }} class="text-gray-500">-- Belum Masuk Rak --</option>

                                        @foreach($shelves as $shelf)
                                        <option value="{{ $shelf->id }}" {{ old('shelf_id', $book->shelf_id) == $shelf->id ? 'selected' : '' }}>
                                            {{ $shelf->nama_rak }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('shelf_id')" class="mt-1" />
                                </div>
                                {{-- No Induk --}}
                                <div class="pt-4 border-t border-gray-800">
                                    <label class="text-[10px] uppercase font-bold text-gray-500 mb-1 block">No. Induk</label>
                                    <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $book->no_induk_buku) }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white font-mono text-sm focus:border-amber-500 focus:ring-amber-500" />
                                    <x-input-error :messages="$errors->get('no_induk_buku')" class="mt-1" />
                                </div>
                            </div>
                        </div>

                        {{-- 3. UPDATE STOK --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h3 class="font-bold text-gray-800 uppercase text-xs mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Update Stok
                            </h3>
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">Total</label>
                                    <input type="number" name="jml_inventaris" value="{{ old('jml_inventaris', $book->jml_inventaris) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div>
                                    <label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">Rak</label>
                                    <input type="number" name="jml_rak" value="{{ old('jml_rak', $book->jml_rak) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div>
                                    <label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">OPAC</label>
                                    <input type="number" name="jml_opac" value="{{ old('jml_opac', $book->jml_opac) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                        <div class="text-sm text-gray-500">Mode Edit Data</div>
                        <div class="flex gap-4">
                            <a href="{{ route('books.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50">Batal</a>
                            <button type="submit" class="px-8 py-2.5 rounded-xl bg-amber-500 text-white font-bold hover:bg-amber-600 shadow-lg">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('cover-preview');
                img.src = reader.result;
                img.classList.remove('hidden');
                document.getElementById('cover-placeholder').classList.add('hidden');
            }
            if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>