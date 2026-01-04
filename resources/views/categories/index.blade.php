<x-app-layout>
    {{--
        X-DATA MASTER:
        Mengatur state untuk Create dan Edit Modal sekaligus.
        Fungsi 'openEditModal' bertugas mengisi form Edit dengan data dari baris tabel yang diklik.
    --}}
    <div x-data="{ 
            openCreate: {{ $errors->has('create_error') ? 'true' : 'false' }},
            openEdit: {{ $errors->has('update_error') ? 'true' : 'false' }},
            editData: { id: '', kode: '', nama: '', action: '' },

            openEditModal(id, kode, nama, url) {
                this.editData.id = id;
                this.editData.kode = kode;
                this.editData.nama = nama;
                this.editData.action = url;
                this.openEdit = true;
            }
        }"
        class="bg-slate-50 min-h-screen pb-20">

        {{-- HEADER --}}
        <div class="bg-white border-b border-gray-200 pt-8 pb-6 px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-cyan-600 p-2.5 rounded-xl text-white shadow-lg shadow-cyan-600/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kategori (DDC)</h2>
                        <p class="text-sm text-gray-500">Master Data Klasifikasi Buku</p>
                    </div>
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    {{-- Search --}}
                    <form action="{{ route('categories.index') }}" method="GET" class="relative w-full md:w-64 group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-cyan-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm transition-shadow shadow-sm"
                            placeholder="Cari Kode atau Nama..." onchange="this.form.submit()">
                    </form>

                    {{-- Tombol Trigger Create --}}
                    <button @click="openCreate = true" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Buat Kategori</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- CONTENT TABLE --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                            <th class="px-6 py-4 w-24">Kode DDC</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4 w-40 text-center">Total Buku</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-sm text-cyan-700 bg-cyan-50 px-2 py-1 rounded-md border border-cyan-100">{{ $category->kode_ddc }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 text-base group-hover:text-cyan-700 transition-colors">{{ $category->nama_kategori }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 {{ $category->books->count() > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $category->books->count() ?: 'Kosong' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- TOMBOL EDIT (Trigger Modal & Kirim Data) --}}
                                    <button
                                        @click="openEditModal('{{ $category->id }}', '{{ $category->kode_ddc }}', '{{ $category->nama_kategori }}', '{{ route('categories.update', $category->id) }}')"
                                        class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all border border-transparent hover:border-red-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada data kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">{{ $categories->links() }}</div>
            </div>
        </div>

        {{-- ============================== --}}
        {{-- MODAL 1: CREATE (TAMBAH BARU)  --}}
        {{-- ============================== --}}
        <div x-show="openCreate" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openCreate = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 relative z-10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Kategori Baru</h3>
                        <button @click="openCreate = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        {{-- Hidden Input untuk deteksi error Create --}}
                        <input type="hidden" name="form_type" value="create">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Kode DDC</label>
                                <input type="text" name="kode_ddc" value="{{ old('kode_ddc') }}" placeholder="000" class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500 font-mono" required>
                                <x-input-error :messages="$errors->get('kode_ddc')" class="mt-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kategori</label>
                                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Contoh: Kesusastraan" class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                                <x-input-error :messages="$errors->get('nama_kategori')" class="mt-1" />
                            </div>
                            <div class="flex gap-3 pt-4 border-t border-gray-100 mt-6">
                                <button type="button" @click="openCreate = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-cyan-600 text-white rounded-xl font-bold hover:bg-cyan-700 shadow-lg">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ============================== --}}
        {{-- MODAL 2: EDIT (UPDATE DATA)    --}}
        {{-- ============================== --}}
        <div x-show="openEdit" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openEdit = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 relative z-10 border-t-4 border-orange-500">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Edit Kategori</h3>
                            <p class="text-sm text-gray-500">Perbarui data klasifikasi.</p>
                        </div>
                        <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    {{-- Form Edit Dynamic Action --}}
                    <form :action="editData.action" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Hidden Input untuk deteksi error Update --}}
                        <input type="hidden" name="form_type" value="update">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Kode DDC</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 font-mono text-sm">#</span>
                                    {{-- x-model mengisi value otomatis dari data tombol edit --}}
                                    <input type="text" name="kode_ddc" x-model="editData.kode"
                                        class="w-full pl-8 rounded-xl border-gray-300 focus:ring-orange-500 focus:border-orange-500 font-mono" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kategori</label>
                                <input type="text" name="nama_kategori" x-model="editData.nama"
                                    class="w-full rounded-xl border-gray-300 focus:ring-orange-500 focus:border-orange-500" required>
                            </div>

                            <div class="flex gap-3 pt-4 border-t border-gray-100 mt-6">
                                <button type="button" @click="openEdit = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 shadow-lg">Update Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>