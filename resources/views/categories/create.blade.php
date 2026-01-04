<x-app-layout>
    <div class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-2xl shadow-lg border border-gray-200 p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Tambah Kategori Baru</h2>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kode DDC</label>
                        <input type="text" name="kode_ddc" placeholder="Contoh: 800" class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" required autofocus>
                        <p class="text-xs text-gray-400 mt-1">Gunakan sistem Dewey Decimal Classification.</p>
                        <x-input-error :messages="$errors->get('kode_ddc')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" placeholder="Contoh: Kesusastraan (Sastra)" class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        <x-input-error :messages="$errors->get('nama_kategori')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('categories.index') }}" class="flex-1 py-3 text-center border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</a>
                        <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>