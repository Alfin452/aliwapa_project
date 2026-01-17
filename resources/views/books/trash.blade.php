<x-app-layout>
    <div class="bg-red-50 min-h-screen pb-20" x-data="{ 
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

        {{-- HEADER SAMPAH --}}
        <div class="bg-white border-b border-red-100 pt-8 pb-6 px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-red-100 p-2.5 rounded-xl text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tong Sampah Buku</h2>
                        <p class="text-sm text-red-500 font-medium">Manajemen Pemulihan Data</p>
                    </div>
                </div>

                <div class="flex gap-3 items-center w-full md:w-auto">
                    {{-- 1. TOMBOL TOGGLE MODE --}}
                    <button @click="selectMode = !selectMode; selected = []"
                        :class="selectMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-600 border border-gray-300 hover:bg-gray-50'"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">
                        <span x-text="selectMode ? 'Batal Pilih' : 'Pilih Banyak'"></span>
                    </button>

                    {{-- 2. GROUP TOMBOL AKSI MASSAL --}}
                    <div x-show="selectMode && selected.length > 0" class="flex gap-2">
                        <form method="POST" id="bulkForm" class="flex gap-2">
                            @csrf
                            <template x-for="id in selected">
                                <input type="hidden" name="ids[]" :value="id">
                            </template>

                            <button type="submit" formaction="{{ route('books.bulkRestore') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-bold shadow-lg transition-colors flex items-center gap-1">
                                Restore (<span x-text="selected.length"></span>)
                            </button>

                            <button type="submit" formaction="{{ route('books.bulkForceDelete') }}" onclick="return confirm('PERINGATAN: Data akan hilang SELAMANYA. Lanjutkan?')" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-bold shadow-lg transition-colors flex items-center gap-1">
                                Hapus (<span x-text="selected.length"></span>)
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('books.index') }}" x-show="!selectMode" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium transition-colors text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        {{-- TABEL SAMPAH --}}
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

            <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-red-50/50 border-b border-red-100 text-xs uppercase text-red-800 font-semibold tracking-wider">

                            {{-- Checkbox Header --}}
                            <th x-show="selectMode" class="px-6 py-4 w-10 text-center bg-gray-100">
                                <input type="checkbox" @click="toggleAll()" :checked="selected.length === {{ $books->count() }} && selected.length > 0" class="rounded border-gray-300 text-red-600 focus:ring-red-500 cursor-pointer">
                            </th>

                            <th class="px-6 py-4">Buku yang Dihapus</th>
                            <th class="px-6 py-4">Dihapus Pada</th>
                            <th class="px-6 py-4 text-right">Opsi Pemulihan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($books as $book)
                        <tr class="hover:bg-red-50/30 transition-colors cursor-pointer"
                            @click="selectMode ? (selected.includes('{{ $book->id }}') ? selected = selected.filter(i => i !== '{{ $book->id }}') : selected.push('{{ $book->id }}')) : null">

                            {{-- Checkbox Row --}}
                            <td x-show="selectMode" class="px-6 py-4 text-center bg-gray-50">
                                <input type="checkbox" value="{{ $book->id }}" x-model="selected" class="rounded border-gray-300 text-red-600 focus:ring-red-500 w-5 h-5 pointer-events-none">
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $book->judul }}</div>
                                <div class="text-xs text-gray-500">{{ $book->pengarang }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $book->deleted_at->format('d M Y H:i') }}
                                <br><span class="text-xs text-red-400">({{ $book->deleted_at->diffForHumans() }})</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                {{-- Tombol Individu --}}
                                <div class="flex items-center justify-end gap-3" x-show="!selectMode">
                                    <form action="{{ route('books.restore', $book->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="px-4 py-2 bg-green-100 text-green-700 hover:bg-green-200 rounded-lg text-xs font-bold transition-colors">Restore</button>
                                    </form>

                                    <form action="{{ route('books.force-delete', $book->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Data akan hilang selamanya. Lanjutkan?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors">Hapus Permanen</button>
                                    </form>
                                </div>
                                <div x-show="selectMode" class="text-xs text-gray-400 italic">
                                    <span x-text="selected.includes('{{ $book->id }}') ? 'Siap' : '-'"></span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Tong sampah kosong. Bagus!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $books->links() }}</div>
        </div>
    </div>
</x-app-layout>