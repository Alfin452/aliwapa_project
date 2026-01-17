<x-app-layout>
    {{-- X-DATA: State untuk Select Mode & Notifikasi --}}
    <div class="bg-slate-50 min-h-screen pb-20"
        x-data="{ 
            selectMode: false, 
            selected: [], 
            toggleAll() {
                if (this.selected.length === {{ $books->count() }}) {
                    this.selected = [];
                } else {
                    this.selected = [
                        @foreach($books as $book)
                            '{{ $book->id }}',
                        @endforeach
                    ];
                }
            }
         }">

        {{-- HEADER --}}
        <div class="bg-white border-b border-gray-200 pt-8 pb-6 px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">

                {{-- Logo & Judul --}}
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2.5 rounded-xl text-white shadow-lg shadow-blue-600/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Arsip Buku</h2>
                        <p class="text-sm text-gray-500">Database Inventaris Perpustakaan</p>
                    </div>
                </div>

                <div class="flex gap-3 w-full md:w-auto items-center">

                    {{-- TOMBOL TOGGLE MODE HAPUS --}}
                    <button @click="selectMode = !selectMode; selected = []"
                        :class="selectMode ? 'bg-red-100 text-red-600 border-red-200' : 'bg-white text-gray-500 border-gray-300 hover:bg-gray-50'"
                        class="p-2.5 border rounded-xl transition-all shadow-sm"
                        title="Mode Hapus Banyak">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>

                    {{-- SEARCH INPUT --}}
                    <div class="relative w-full md:w-72 group" x-show="!selectMode">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-shadow shadow-sm"
                            placeholder="Cari Judul, Barcode, Penulis..."
                            autocomplete="off">

                        <div id="searchSpinner" class="absolute inset-y-0 right-0 pr-3 flex items-center hidden">
                            <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- TOMBOL EKSEKUSI HAPUS --}}
                    <form action="{{ route('books.bulkDelete') }}" method="POST" x-show="selectMode && selected.length > 0" class="flex items-center" onsubmit="return confirm('Yakin ingin memindahkan buku terpilih ke sampah?')">
                        @csrf
                        <template x-for="id in selected">
                            <input type="hidden" name="ids[]" :value="id">
                        </template>

                        <button type="submit" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg animate-bounce whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span>Hapus (<span x-text="selected.length"></span>)</span>
                        </button>
                    </form>

                    {{-- Tombol + Input --}}
                    <a href="{{ route('books.create') }}" x-show="!selectMode" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap">
                        <span>+ Input</span>
                    </a>

                    {{-- Tombol Import --}}
                    <div x-data="{ openImport: false }" class="relative" x-show="!selectMode">
                        <button @click="openImport = true" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-xl font-medium transition-all shadow-md hover:shadow-lg whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Import</span>
                        </button>

                        <div x-show="openImport" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="openImport = false"></div>
                            <div class="relative min-h-screen flex items-center justify-center p-4">
                                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 relative z-10">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-bold text-gray-900">Import Data Excel</h3>
                                        <button @click="openImport = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-2">1. Download template terlebih dahulu:</p>
                                            <a href="{{ route('books.template') }}" class="flex items-center justify-center gap-2 w-full py-2 border border-green-500 text-green-600 rounded-lg hover:bg-green-50 font-medium text-sm transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                                Download Template.xlsx
                                            </a>
                                        </div>
                                        <div class="mb-6">
                                            <p class="text-sm text-gray-500 mb-2">2. Upload file yang sudah diisi:</p>
                                            <input type="file" name="file" accept=".xlsx, .xls" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                        </div>
                                        <div class="flex justify-end gap-3">
                                            <button type="button" @click="openImport = false" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium">Batal</button>
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 shadow-lg">Upload & Proses</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('books.trash') }}" x-show="!selectMode" class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-red-600 px-4 py-2.5 rounded-xl font-medium transition-all shadow-sm whitespace-nowrap" title="Lihat Buku Dihapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

            {{-- 🟢 PERBAIKAN: NOTIFIKASI SUKSES DISINI 🟢 --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="mb-6 bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold tracking-wider">

                                {{-- KOLOM CHECKBOX "SELECT ALL" --}}
                                <th x-show="selectMode" class="px-6 py-4 w-10 text-center bg-red-50">
                                    <input type="checkbox" @click="toggleAll()" :checked="selected.length === {{ $books->count() }} && selected.length > 0" class="rounded border-gray-300 text-red-600 focus:ring-red-500 w-5 h-5 cursor-pointer">
                                </th>

                                <th class="px-6 py-4 w-16 text-center">No</th>
                                <th class="px-6 py-4 w-20">Cover</th>
                                <th class="px-6 py-4">Informasi Buku</th>
                                <th class="px-6 py-4">Lokasi & Kategori</th>
                                <th class="px-6 py-4">Stok</th>
                                <th class="px-6 py-4 text-center">Input</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="booksTableBody" class="divide-y divide-gray-100 bg-white">
                            @include('books.partials.table-rows')
                        </tbody>
                    </table>
                </div>

                <div id="paginationContainer" class="bg-gray-50 border-t border-gray-200 px-6 py-4" x-show="!selectMode">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT MANUAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('booksTableBody');
            const spinner = document.getElementById('searchSpinner');
            const pagination = document.getElementById('paginationContainer');
            let timeout = null;

            const skeletonHtml = `
                ${Array(5).fill().map(() => `
                <tr class="animate-pulse border-b border-gray-100">
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-8 mx-auto"></div></td>
                    <td class="px-6 py-4"><div class="h-16 w-12 bg-gray-200 rounded"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div><div class="h-3 bg-gray-200 rounded w-1/2"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24"></div></td>
                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-16"></div></td>
                    <td class="px-6 py-4"><div class="h-8 w-8 bg-gray-200 rounded-full mx-auto"></div></td>
                    <td class="px-6 py-4"><div class="h-8 w-16 bg-gray-200 rounded ml-auto"></div></td>
                </tr>
                `).join('')}
            `;

            searchInput.addEventListener('input', function(e) {
                const query = e.target.value;
                spinner.classList.remove('hidden');
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    tableBody.innerHTML = skeletonHtml;
                    fetch(`{{ route('books.index') }}?search=${query}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            tableBody.innerHTML = html;
                            spinner.classList.add('hidden');
                            if (query.length > 0) {
                                pagination.style.display = 'none';
                            } else {
                                window.location.href = "{{ route('books.index') }}";
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            spinner.classList.add('hidden');
                        });
                }, 500);
            });
        });
    </script>
</x-app-layout>