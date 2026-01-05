<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Pengadaan</h2>
    </x-slot>

    <style>
        @media print {
            @page {
                margin: 0;
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
                padding: 2cm;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FILTER TANGGAL (Hanya Tampil di Layar) --}}
            <div class="bg-white p-4 rounded-lg shadow mb-6 no-print flex flex-col md:flex-row gap-4 items-end">
                <form action="{{ route('reports.pengadaan') }}" method="GET" class="flex gap-4 w-full">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="pb-0.5">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Filter Data</button>
                    </div>
                </form>
                <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-black whitespace-nowrap">
                    Cetak Laporan
                </button>
            </div>

            <div id="print-area" class="bg-white p-8 rounded-lg shadow">
                <div class="text-center border-b-2 border-black pb-4 mb-6">
                    <h1 class="text-2xl font-bold uppercase">Perpustakaan Digital</h1>
                    <h2 class="text-lg font-semibold uppercase">Laporan Pengadaan Buku Baru</h2>
                    <p class="text-sm text-gray-600">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
                </div>

                <table class="w-full text-left border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="border border-gray-300 p-2 w-10">No</th>
                            <th class="border border-gray-300 p-2 w-32">Tgl Input</th>
                            <th class="border border-gray-300 p-2 w-32">No. Induk</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2 w-40">Pengarang</th>
                            <th class="border border-gray-300 p-2 w-20">Tahun</th>
                            <th class="border border-gray-300 p-2 w-24">Asal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $book->created_at->format('d/m/Y') }}</td>
                            <td class="border border-gray-300 p-2 font-bold">{{ $book->no_induk_buku }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->judul }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->pengarang }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $book->tahun_terbit }}</td>
                            <td class="border border-gray-300 p-2 text-center">Pengadaan</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 p-4 text-center italic">Tidak ada pengadaan buku pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4 text-sm font-bold">
                    Total Buku Masuk: {{ $books->count() }} Eksemplar
                </div>

                {{-- Tanda Tangan --}}
                <div class="flex justify-end mt-12">
                    <div class="text-center pr-8">
                        <p class="mb-16">Mengetahui,<br>Kepala Perpustakaan</p>
                        <p class="font-bold underline">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>