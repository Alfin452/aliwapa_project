<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Stock Opname</h2>
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
            <div class="flex justify-end mb-4 no-print">
                <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-black">Cetak Lembar Checklist</button>
            </div>

            <div id="print-area" class="bg-white p-8 rounded-lg shadow">
                <div class="text-center border-b-2 border-black pb-4 mb-6">
                    <h1 class="text-2xl font-bold uppercase">Perpustakaan Digital</h1>
                    <h2 class="text-lg font-semibold uppercase">Lembar Kerja Stock Opname (Cek Fisik)</h2>
                    <p class="text-sm text-gray-500">Urutan Berdasarkan: Lokasi Rak & Nomor Induk</p>
                </div>

                <table class="w-full text-left border-collapse border border-gray-300 text-xs">
                    <thead>
                        <tr class="bg-gray-100 text-center uppercase">
                            <th class="border border-gray-300 p-2 w-8">No</th>
                            <th class="border border-gray-300 p-2 w-24">Lokasi Rak</th>
                            <th class="border border-gray-300 p-2 w-24">No. Induk</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2 w-12">Ada</th>
                            <th class="border border-gray-300 p-2 w-12">Hilang</th>
                            <th class="border border-gray-300 p-2 w-32">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $currentShelf = null; @endphp
                        @foreach($books as $index => $book)

                        {{-- Pemisah Antar Rak --}}
                        @if($currentShelf !== $book->shelf_id)
                        @php $currentShelf = $book->shelf_id; @endphp
                        <tr class="bg-gray-200 font-bold">
                            <td colspan="7" class="border border-gray-300 p-2">
                                LOKASI: {{ $book->shelf->nama_rak ?? 'Gudang / Tanpa Rak' }}
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $book->shelf->nama_rak ?? '-' }}</td>
                            <td class="border border-gray-300 p-2 font-bold">{{ $book->no_induk_buku }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->judul }}</td>
                            {{-- Kotak Checklist Kosong --}}
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-8 flex justify-between px-8">
                    <div class="text-center">
                        <p class="mb-16">Petugas Pemeriksa</p>
                        <p class="font-bold underline">..............................</p>
                    </div>
                    <div class="text-center">
                        <p class="mb-16">Tanggal Pemeriksaan</p>
                        <p class="font-bold underline">...... / ...... / 20......</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>