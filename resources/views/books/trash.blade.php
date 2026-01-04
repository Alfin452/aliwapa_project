<x-app-layout>
    <div class="bg-red-50 min-h-screen pb-20">

        {{-- HEADER SAMPAH --}}
        <div class="bg-white border-b border-red-100 pt-8 pb-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-red-100 p-2.5 rounded-xl text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tong Sampah Buku</h2>
                        <p class="text-sm text-red-500 font-medium">Data di sini bisa dipulihkan atau dihapus selamanya.</p>
                    </div>
                </div>

                <a href="{{ route('books.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Buku
                </a>
            </div>
        </div>

        {{-- TABEL SAMPAH --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-red-50/50 border-b border-red-100 text-xs uppercase text-red-800 font-semibold tracking-wider">
                            <th class="px-6 py-4">Buku yang Dihapus</th>
                            <th class="px-6 py-4">Dihapus Pada</th>
                            <th class="px-6 py-4 text-right">Opsi Pemulihan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($books as $book)
                        <tr class="hover:bg-red-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $book->judul }}</div>
                                <div class="text-xs text-gray-500">{{ $book->pengarang }}</div>
                                <div class="text-[10px] text-gray-400 font-mono mt-1">{{ $book->no_barcode ?? 'No Barcode' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $book->deleted_at->format('d M Y H:i') }}
                                <br><span class="text-xs text-red-400">({{ $book->deleted_at->diffForHumans() }})</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    {{-- Tombol Restore --}}
                                    <form action="{{ route('books.restore', $book->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="px-4 py-2 bg-green-100 text-green-700 hover:bg-green-200 rounded-lg text-xs font-bold transition-colors flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Restore
                                        </button>
                                    </form>

                                    {{-- Tombol Hapus Permanen --}}
                                    <form action="{{ route('books.force-delete', $book->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Data akan hilang selamanya dan tidak bisa dikembalikan. Lanjutkan?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus Permanen
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                Tong sampah kosong. Bagus!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>