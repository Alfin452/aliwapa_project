<x-app-layout>
    <div class="bg-slate-50 min-h-screen pb-20">

        {{-- HEADER --}}
        <div class="bg-white border-b border-gray-200 pt-8 pb-6 px-4 sm:px-6 lg:px-8 shadow-sm">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard</h2>
                <p class="text-gray-500 mt-1">Selamat datang kembali, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>!</p>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-8">

            {{-- 1. KARTU STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Card Buku --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-blue-50 to-transparent"></div>
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-blue-100 text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Buku</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-3xl font-bold text-gray-900">{{ $totalBooks }}</p>
                    </dd>
                    <a href="{{ route('books.index') }}" class="absolute bottom-4 right-4 text-xs font-bold text-blue-600 hover:underline">Lihat Detail &rarr;</a>
                </div>

                {{-- Card Kategori --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-cyan-50 to-transparent"></div>
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-cyan-100 text-cyan-600 mb-4 group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Kategori DDC</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-3xl font-bold text-gray-900">{{ $totalCategories }}</p>
                    </dd>
                    <a href="{{ route('categories.index') }}" class="absolute bottom-4 right-4 text-xs font-bold text-cyan-600 hover:underline">Kelola &rarr;</a>
                </div>

                {{-- Card Rak --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-purple-50 to-transparent"></div>
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-purple-100 text-purple-600 mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Lokasi Rak</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-3xl font-bold text-gray-900">{{ $totalShelves }}</p>
                    </dd>
                    <a href="{{ route('shelves.index') }}" class="absolute bottom-4 right-4 text-xs font-bold text-purple-600 hover:underline">Kelola &rarr;</a>
                </div>

                {{-- Card User (Khusus Admin) --}}
                @if(Auth::user()->role === 'admin')
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-indigo-50 to-transparent"></div>
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-100 text-indigo-600 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-16 text-sm font-medium text-gray-500 truncate">Karyawan</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                    </dd>
                    <a href="{{ route('users.index') }}" class="absolute bottom-4 right-4 text-xs font-bold text-indigo-600 hover:underline">Kelola User &rarr;</a>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- 2. TABEL BUKU TERBARU (Lebar 2/3) --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-900">Buku Baru Masuk</h3>
                        <a href="{{ route('books.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Judul Buku</th>
                                <th class="px-6 py-3">No. Induk</th>
                                <th class="px-6 py-3 text-right">Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentBooks as $book)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-10 bg-gray-200 rounded overflow-hidden flex-shrink-0">
                                            @if($book->cover)
                                            <img src="{{ asset('storage/'.$book->cover) }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 line-clamp-1">{{ $book->judul }}</div>
                                            <div class="text-xs text-gray-400">{{ $book->pengarang }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded border border-gray-200 text-gray-600">
                                        {{ $book->no_induk_buku }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-xs text-gray-400">
                                    {{ $book->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">Belum ada buku yang diinput.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 3. SHORTCUT MENU (Lebar 1/3) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('books.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-50 border border-gray-100 hover:border-blue-100 transition-all group">
                            <div class="bg-blue-500 text-white p-2 rounded-lg group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">Input Buku Baru</div>
                                <div class="text-xs text-gray-500">Tambah koleksi manual</div>
                            </div>
                        </a>

                        <a href="{{ route('books.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-50 border border-gray-100 hover:border-green-100 transition-all group">
                            <div class="bg-green-500 text-white p-2 rounded-lg group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">Import Excel</div>
                                <div class="text-xs text-gray-500">Upload data massal</div>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-100 transition-all group">
                            <div class="bg-gray-700 text-white p-2 rounded-lg group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">Profil Saya</div>
                                <div class="text-xs text-gray-500">Edit akun & password</div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>