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
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    {{-- KOLOM KIRI --}}
                    <div class="lg:col-span-8 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-bold text-gray-800 text-lg">Bibliografi Utama</h3>
                            </div>
                            <div class="space-y-8">
                                <div class="relative group">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul', $book->judul) }}" class="block px-4 pb-3 pt-6 w-full text-base bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer" required />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Judul Buku</label>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="relative">
                                        <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200" required />
                                        <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Penulis</label>
                                    </div>
                                    <div class="relative">
                                        <select id="category_id" name="category_id" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200">
                                            <option value="">-- Tanpa Kategori --</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->kode_ddc }} - {{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Kategori Klasifikasi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-bold text-gray-800 text-lg">Publikasi</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="md:col-span-3 relative">
                                    <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Penerbit</label>
                                </div>
                                <div class="relative">
                                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer" />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Tahun</label>
                                </div>
                                <div class="md:col-span-2 relative">
                                    <input type="text" name="tempat_terbit" value="{{ old('tempat_terbit', $book->tempat_terbit) }}" class="block px-4 pb-3 pt-6 w-full text-sm bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 focus:bg-white peer" />
                                    <label class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-4 left-4">Kota</label>
                                </div>
                            </div>
                            <textarea name="keterangan" rows="3" class="block w-full px-4 py-3 bg-gray-50 rounded-xl border-0 border-b-2 border-gray-200 text-sm" placeholder="Keterangan tambahan...">{{ old('keterangan', $book->keterangan) }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
                            <div class="relative w-full h-64 rounded-xl overflow-hidden group border-2 border-dashed border-gray-300 bg-gray-50">
                                <img id="cover-preview" src="{{ $book->cover ? asset('storage/'.$book->cover) : '' }}" class="{{ $book->cover ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-10" />
                                <div id="cover-placeholder" class="{{ $book->cover ? 'hidden' : '' }} absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                                    <h4 class="text-sm font-bold text-gray-800">Ganti Cover</h4>
                                </div>
                                <input type="file" name="cover" class="absolute inset-0 w-full h-full opacity-0 z-20 cursor-pointer" onchange="previewImage(event)">
                            </div>
                        </div>

                        <div class="bg-gray-900 rounded-2xl shadow-lg p-6 text-white relative">
                            <h3 class="font-bold uppercase text-xs mb-6">Aset Fisik</h3>
                            <div class="space-y-5">
                                <div><label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Barcode</label>
                                    <input type="text" name="no_barcode" value="{{ old('no_barcode', $book->no_barcode) }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white font-mono text-sm" />
                                </div>
                                <div><label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Lokasi Rak</label>
                                    <select name="shelf_id" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white text-sm">
                                        <option value="">-- Belum Rak --</option>
                                        @foreach($shelves as $shelf)
                                        <option value="{{ $shelf->id }}" {{ old('shelf_id', $book->shelf_id) == $shelf->id ? 'selected' : '' }}>{{ $shelf->nama_rak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="pt-4 border-t border-gray-800"><label class="text-[10px] uppercase font-bold text-gray-500 block mb-1">No. Induk</label>
                                    <input type="text" name="no_induk_buku" value="{{ old('no_induk_buku', $book->no_induk_buku) }}" class="block w-full px-3 py-2 bg-gray-800 border-gray-700 rounded-lg text-white font-mono text-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h3 class="font-bold text-gray-800 uppercase text-xs mb-4">Update Stok</h3>
                            <div class="grid grid-cols-3 gap-3">
                                <div><label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">Total</label>
                                    <input type="number" id="jml_inventaris" name="jml_inventaris" value="{{ old('jml_inventaris', $book->jml_inventaris) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2">
                                </div>
                                <div><label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">Rak</label>
                                    <input type="number" id="jml_rak" name="jml_rak" value="{{ old('jml_rak', $book->jml_rak) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2">
                                </div>
                                <div><label class="text-[10px] text-center block mb-1 font-bold text-gray-400 uppercase">OPAC</label>
                                    <input type="number" id="jml_opac" name="jml_opac" value="{{ old('jml_opac', $book->jml_opac) }}" class="w-full text-center bg-gray-50 border-gray-200 rounded-lg font-bold py-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200 py-4">
                    <div class="max-w-7xl mx-auto px-4 flex justify-end gap-4">
                        <a href="{{ route('books.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 font-bold">Batal</a>
                        <button type="submit" class="px-8 py-2.5 rounded-xl bg-amber-500 text-white font-bold shadow-lg">Simpan Perubahan</button>
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