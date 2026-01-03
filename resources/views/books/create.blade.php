<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Data Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Formulir Inventaris Perpustakaan</h3>
                    <p class="text-sm text-gray-600">Silakan isi data buku sesuai fisik buku yang ada.</p>
                </div>

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nomor Induk Buku</label>
                            <input type="text" name="nomor_induk_buku" value="{{ old('nomor_induk_buku') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200" placeholder="Contoh: NB-001" required>
                            @error('nomor_induk_buku') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nomor Barcode</label>
                            <input type="text" name="nomor_barcode" value="{{ old('nomor_barcode') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200" placeholder="Scan Barcode..." required>
                            @error('nomor_barcode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700">Judul Buku</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 text-blue-600">Kategori (Wajib Pilih)</label>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm bg-blue-50">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Pengarang</label>
                            <input type="text" name="pengarang" value="{{ old('pengarang') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tempat Terbit</label>
                            <input type="text" name="tempat_terbit" value="{{ old('tempat_terbit') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Penerbit</label>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="2024" required>
                        </div>

                        <div class="md:col-span-2 border-t pt-4 mt-2">
                            <h4 class="font-bold text-gray-500 text-xs uppercase tracking-wider">Data Inventaris & Stok</h4>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jumlah Eksmplar Inventaris</label>
                            <input type="number" name="qty_inventaris" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jumlah Eksmplar OPAC</label>
                            <input type="number" name="qty_opac" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jumlah Eksmplar di Rak</label>
                            <input type="number" name="qty_rak" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 text-blue-600">Disimpan di Rak Mana? (Wajib)</label>
                            <select name="shelf_id" class="w-full border-gray-300 rounded-md shadow-sm bg-blue-50">
                                <option value="">-- Pilih Rak --</option>
                                @foreach($shelves as $shelf)
                                <option value="{{ $shelf->id }}">{{ $shelf->nama_rak }} - {{ $shelf->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-lg transition hover:scale-105">
                            Simpan Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>