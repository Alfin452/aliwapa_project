<x-app-layout>
    {{-- Tambahkan CDN Chart.js di sini --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="bg-slate-50 min-h-screen pb-20">

        {{-- 1. WELCOME BANNER --}}
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Dashboard Overview</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Halo, <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span>! Berikut ringkasan perpustakaan hari ini.
                        </p>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-8">

            {{-- 2. KARTU STATISTIK (Grid 4 Kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Card 1: Total Judul --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Judul Buku</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTitles }}</h3>
                            <p class="text-xs text-green-600 mt-1 flex items-center font-medium">
                                <span class="bg-green-100 px-1.5 py-0.5 rounded text-[10px] mr-1">+{{ $newBooksThisMonth }}</span>
                                bulan ini
                            </p>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Total Eksemplar (Fisik) --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Eksemplar</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCopies }}</h3>
                            <p class="text-xs text-gray-400 mt-1">Stok fisik di rak</p>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Kategori --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Kategori DDC</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCategories }}</h3>
                            <p class="text-xs text-gray-400 mt-1">Klasifikasi aktif</p>
                        </div>
                        <div class="p-3 bg-cyan-50 text-cyan-600 rounded-xl group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 4: User (Admin Only) --}}
                @if(Auth::user()->role === 'admin')
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</h3>
                            <p class="text-xs text-gray-400 mt-1">Admin & Staff</p>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- 3. BAGIAN TENGAH: GRAFIK & AKTIVITAS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- A. TABEL BUKU TERBARU (Lebar 2 Kolom) --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="font-bold text-gray-900">Buku Baru Masuk</h3>
                            <p class="text-xs text-gray-500">5 data terakhir yang diinput ke sistem</p>
                        </div>
                        <a href="{{ route('books.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-white border-b border-gray-100 text-xs uppercase font-semibold text-gray-500 tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Buku</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4 text-center">Stok</th>
                                    <th class="px-6 py-4 text-right">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentBooks as $book)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-12 bg-gray-100 rounded border border-gray-200 overflow-hidden flex-shrink-0">
                                                @if($book->cover)
                                                <img src="{{ asset('storage/'.$book->cover) }}" class="w-full h-full object-cover">
                                                @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 line-clamp-1 text-sm">{{ $book->judul }}</div>
                                                <div class="text-xs text-gray-400 mt-0.5">{{ $book->pengarang }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $book->category->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-mono text-gray-900 font-bold">{{ $book->jml_inventaris }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-xs text-gray-400">
                                        {{ $book->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">Belum ada buku yang diinput.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- B. CHART & SHORTCUT (Lebar 1 Kolom) --}}
                <div class="space-y-6">

                    {{-- Chart Kategori --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Populasi Kategori</h3>
                        <div class="relative h-48 w-full flex justify-center">
                            @if(count($chartLabels) > 0)
                            <canvas id="categoryChart"></canvas>
                            @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-sm">Belum ada data statistik.</div>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Menu --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-1 gap-3">
                            <a href="{{ route('books.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-600 hover:text-white border border-gray-100 hover:border-blue-600 transition-all group">
                                <div class="bg-white text-blue-600 p-2 rounded-lg shadow-sm group-hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Input Buku</div>
                                </div>
                            </a>

                            <a href="{{ route('books.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-600 hover:text-white border border-gray-100 hover:border-green-600 transition-all group">
                                <div class="bg-white text-green-600 p-2 rounded-lg shadow-sm group-hover:text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Import Excel</div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Chart.js --}}
    @if(count($chartLabels) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {
                        !!json_encode($chartLabels) !!
                    },
                    datasets: [{
                        data: {
                            !!json_encode($chartValues) !!
                        },
                        backgroundColor: [
                            '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    cutout: '70%',
                }
            });
        });
    </script>
    @endif
</x-app-layout>