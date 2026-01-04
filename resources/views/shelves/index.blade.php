<x-app-layout>
    {{-- State Management untuk Modal (Sama seperti Kategori) --}}
    <div x-data="{ 
            openCreate: {{ $errors->has('nama_rak') && !$errors->has('form_type') ? 'true' : 'false' }},
            openEdit: {{ $errors->has('form_type') && old('form_type') == 'update' ? 'true' : 'false' }},
            editData: { id: '', nama: '', lokasi: '', action: '' },

            openEditModal(id, nama, lokasi, url) {
                this.editData.id = id;
                this.editData.nama = nama;
                this.editData.lokasi = lokasi;
                this.editData.action = url;
                this.openEdit = true;
            }
        }"
        class="bg-slate-50 min-h-screen pb-20">

        {{-- HEADER (Tema Ungu/Purple) --}}
        <div class="bg-white border-b border-gray-200 pt-8 pb-6 px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-600 p-2.5 rounded-xl text-white shadow-lg shadow-purple-600/30">
                        {{-- Ikon Rak --}}
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Lokasi Rak</h2>
                        <p class="text-sm text-gray-500">Master Data Penyimpanan Fisik</p>
                    </div>
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    {{-- Search --}}
                    <form action="{{ route('shelves.index') }}" method="GET" class="relative w-full md:w-64 group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition-shadow shadow-sm"
                            placeholder="Cari Nama Rak..." onchange="this.form.submit()">
                    </form>

                    {{-- Tombol Tambah --}}
                    <button @click="openCreate = true" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Rak</span>
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
                            <th class="px-6 py-4">Nama Rak</th>
                            <th class="px-6 py-4">Keterangan Lokasi</th>
                            <th class="px-6 py-4 w-40 text-center">Isi Buku</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($shelves as $shelf)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 group-hover:text-purple-700 transition-colors">{{ $shelf->nama_rak }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">
                                {{ $shelf->lokasi ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 {{ $shelf->books->count() > 0 ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-500' }} px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $shelf->books->count() }} Pcs
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit Button --}}
                                    <button
                                        @click="openEditModal('{{ $shelf->id }}', '{{ $shelf->nama_rak }}', '{{ $shelf->lokasi }}', '{{ route('shelves.update', $shelf->id) }}')"
                                        class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('shelves.destroy', $shelf->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus rak ini?');">
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada data rak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">{{ $shelves->links() }}</div>
            </div>
        </div>

        {{-- MODAL CREATE --}}
        <div x-show="openCreate" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openCreate = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 relative z-10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Rak Baru</h3>
                        <button @click="openCreate = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    <form action="{{ route('shelves.store') }}" method="POST">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Rak</label>
                                <input type="text" name="nama_rak" value="{{ old('nama_rak') }}" placeholder="Contoh: Rak A1, Lemari Besi" class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>
                                <x-input-error :messages="$errors->get('nama_rak')" class="mt-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi Detail (Opsional)</label>
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lantai 2, Pojok Kanan" class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            <div class="flex gap-3 pt-4 mt-6 border-t border-gray-100">
                                <button type="button" @click="openCreate = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 shadow-lg">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div x-show="openEdit" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openEdit = false"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 relative z-10 border-t-4 border-orange-500">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Edit Rak</h3>
                        <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600 bg-gray-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg></button>
                    </div>

                    <form :action="editData.action" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="form_type" value="update">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Rak</label>
                                <input type="text" name="nama_rak" x-model="editData.nama" class="w-full rounded-xl border-gray-300 focus:ring-orange-500 focus:border-orange-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi Detail</label>
                                <input type="text" name="lokasi" x-model="editData.lokasi" class="w-full rounded-xl border-gray-300 focus:ring-orange-500 focus:border-orange-500">
                            </div>
                            <div class="flex gap-3 pt-4 mt-6 border-t border-gray-100">
                                <button type="button" @click="openEdit = false" class="flex-1 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 shadow-lg">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>