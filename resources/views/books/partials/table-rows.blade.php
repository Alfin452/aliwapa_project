{{-- STATUS BUKU LOGIC --}}
@forelse($books as $index => $book)
<tr class="hover:bg-gray-50/80 transition-colors group border-b border-gray-100 last:border-0">
    {{-- Nomor --}}
    <td class="px-6 py-4 text-center text-gray-400 text-sm">
        {{ ($books->currentpage()-1) * $books->perpage() + $index + 1 }}
    </td>

    {{-- Thumbnail --}}
    <td class="px-6 py-4">
        <div class="w-12 h-16 rounded bg-gray-200 overflow-hidden border border-gray-300 shadow-sm relative group-hover:scale-110 transition-transform">
            @if($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover" loading="lazy" alt="Cover">
            @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            @endif
        </div>
    </td>

    {{-- Informasi Buku --}}
    <td class="px-6 py-4">
        <div class="font-bold text-gray-900 text-base mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $book->judul }}</div>
        <div class="flex flex-col gap-1">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="font-medium text-gray-700">{{ $book->pengarang }}</span>
                <span>&bull;</span>
                <span>{{ $book->penerbit }} ({{ $book->tahun_terbit }})</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[10px] font-mono border border-gray-200" title="Nomor Barcode">
                    {{ $book->no_barcode ?? '-' }}
                </span>
                {{-- INFO BARU: Status Ketersediaan --}}
                @if($book->jml_rak > 0)
                <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Tersedia
                </span>
                @else
                <span class="text-[10px] bg-red-100 text-red-700 px-2 py-0.5 rounded-full font-bold">
                    Habis Dipinjam
                </span>
                @endif
            </div>
        </div>
    </td>

    {{-- Lokasi --}}
    <td class="px-6 py-4">
        <div class="flex flex-col gap-2 items-start">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">
                {{ $book->category->kode_ddc ?? '' }} - {{ $book->category->nama_kategori ?? 'Uncategorized' }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                {{ $book->shelf->nama_rak ?? 'Gudang' }}
            </span>
        </div>
    </td>

    {{-- Stok Detail --}}
    <td class="px-6 py-4">
        <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs">
            <div class="text-gray-500">Total:</div>
            <div class="font-bold text-gray-900 text-right">{{ $book->jml_inventaris }}</div>

            <div class="text-gray-500">Rak:</div>
            <div class="font-bold text-blue-600 text-right">{{ $book->jml_rak }}</div>

            <div class="text-gray-500">OPAC:</div>
            <div class="font-bold text-gray-900 text-right">{{ $book->jml_opac }}</div>
        </div>
    </td>

    {{-- Penginput --}}
    <td class="px-6 py-4 text-center">
        <div class="flex flex-col items-center group/user relative">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-xs font-bold mb-1 shadow-sm cursor-help">
                {{ substr($book->user->name, 0, 1) }}
            </div>
            <span class="text-[10px] text-gray-500 font-medium truncate w-20">{{ $book->user->name }}</span>
            <span class="text-[9px] text-gray-400">{{ $book->created_at->diffForHumans() }}</span>

            {{-- Tooltip Hover --}}
            <div class="absolute bottom-full mb-2 hidden group-hover/user:block bg-gray-900 text-white text-[10px] p-2 rounded w-max z-20">
                Diinput: {{ $book->created_at->format('d M Y H:i') }}
            </div>
        </div>
    </td>

    {{-- Aksi --}}
    <td class="px-6 py-4 text-right">
        @if(auth()->user()->role === 'admin' || auth()->id() === $book->user_id)
        <div class="flex items-center justify-end gap-2">
            {{-- Edit --}}
            <a href="{{ route('books.edit', $book->id) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100" title="Edit Data">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </a>
            {{-- Hapus --}}
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus buku ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all border border-transparent hover:border-red-100" title="Hapus Permanen">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
        @else
        <span class="inline-flex items-center gap-1 px-2 py-1 rounded border border-gray-200 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase tracking-wider cursor-not-allowed opacity-70">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            Locked
        </span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
        <div class="flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-base font-medium text-gray-900">Data tidak ditemukan</p>
            <p class="text-sm mt-1">Coba kata kunci lain atau input buku baru.</p>
        </div>
    </td>
</tr>
@endforelse