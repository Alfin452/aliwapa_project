<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Buku Induk
        </h2>
    </x-slot>

    {{-- STYLE KHUSUS PRINT --}}
    <style>
        @media print {
            @page {
                margin: 0;
                size: landscape;
            }

            /* Paksa Landscape agar muat */
            body {
                background-color: white;
            }

            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 1cm;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
            }

            /* Font kecil agar muat */
            th,
            td {
                border: 1px solid black;
                padding: 4px;
            }

            th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                text-align: center;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol Aksi --}}
            <div class="flex justify-end mb-4 no-print">
                <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-black flex items-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak Buku Induk (Landscape)
                </button>
            </div>

            <div id="print-area" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- KOP LAPORAN --}}
                <div class="text-center border-b-2 border-black pb-4 mb-6">
                    <h1 class="text-2xl font-bold uppercase">Perpustakaan Digital</h1>
                    <h2 class="text-xl font-semibold uppercase">Buku Induk Perpustakaan</h2>
                    <p class="text-sm text-gray-500">Dicetak pada: {{ date('d F Y') }}</p>
                </div>

                {{-- TABEL DATA LENGKAP --}}
                <table class="w-full text-left border border-gray-300 text-xs">
                    <thead>
                        <tr class="bg-gray-100 uppercase tracking-wider">
                            <th class="p-2 border border-gray-300 text-center w-8">No</th>
                            <th class="p-2 border border-gray-300 w-24">No. Induk</th>
                            <th class="p-2 border border-gray-300 w-24">Barcode</th>
                            <th class="p-2 border border-gray-300">Judul Buku</th>
                            <th class="p-2 border border-gray-300 w-32">Pengarang</th>
                            <th class="p-2 border border-gray-300 w-32">Penerbit</th>
                            <th class="p-2 border border-gray-300 w-16 text-center">Tahun</th>
                            <th class="p-2 border border-gray-300 w-24">Kategori</th>
                            <th class="p-2 border border-gray-300 w-20">Rak</th>
                            <th class="p-2 border border-gray-300 w-16 text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border border-gray-300 text-center">{{ $index + 1 }}</td>
                            <td class="p-2 border border-gray-300 font-bold">{{ $book->no_induk_buku }}</td>
                            <td class="p-2 border border-gray-300 font-mono">{{ $book->no_barcode ?? '-' }}</td>
                            <td class="p-2 border border-gray-300">{{ $book->judul }}</td>
                            <td class="p-2 border border-gray-300">{{ $book->pengarang }}</td>
                            <td class="p-2 border border-gray-300">
                                {{ $book->penerbit }} <br>
                                <span class="text-[10px] text-gray-500">{{ $book->tempat_terbit }}</span>
                            </td>
                            <td class="p-2 border border-gray-300 text-center">{{ $book->tahun_terbit }}</td>
                            <td class="p-2 border border-gray-300">
                                {{ $book->category->kode_ddc ?? '' }}
                            </td>
                            <td class="p-2 border border-gray-300">{{ $book->shelf->nama_rak ?? '-' }}</td>
                            <td class="p-2 border border-gray-300 text-center font-bold">{{ $book->jml_inventaris }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="p-4 text-center border border-gray-300">Tidak ada data buku.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- FOOTER TTD --}}
                <div class="flex justify-end mt-8 break-inside-avoid">
                    <div class="text-center pr-8">
                        <p class="mb-16">Mengetahui,<br>Kepala Perpustakaan</p>
                        <p class="font-bold underline">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>