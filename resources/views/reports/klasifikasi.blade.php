<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Klasifikasi</h2>
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4 no-print">
                <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-black">Cetak Rekapitulasi</button>
            </div>

            <div id="print-area" class="bg-white p-8 rounded-lg shadow">
                <div class="text-center border-b-2 border-black pb-4 mb-6">
                    <h1 class="text-2xl font-bold uppercase">Perpustakaan Digital</h1>
                    <h2 class="text-lg font-semibold uppercase">Laporan Rekapitulasi Klasifikasi (DDC)</h2>
                    <p class="text-sm text-gray-500">Dicetak pada: {{ date('d F Y') }}</p>
                </div>

                <table class="w-full text-left border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-center uppercase text-sm font-bold">
                            <th class="border border-gray-300 p-3 w-12">No</th>
                            <th class="border border-gray-300 p-3 w-32">Kode DDC</th>
                            <th class="border border-gray-300 p-3">Nama Kategori / Klasifikasi</th>
                            <th class="border border-gray-300 p-3 w-40">Jumlah Judul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $cat)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2 text-center font-bold">{{ $cat->kode_ddc }}</td>
                            <td class="border border-gray-300 p-2">{{ $cat->nama_kategori }}</td>
                            <td class="border border-gray-300 p-2 text-center font-bold">{{ $cat->books_count }}</td>
                        </tr>
                        @endforeach
                        @if($uncategorizedCount > 0)
                        <tr class="bg-yellow-50">
                            <td class="border border-gray-300 p-2 text-center">-</td>
                            <td class="border border-gray-300 p-2 text-center">-</td>
                            <td class="border border-gray-300 p-2 italic text-red-600">Belum Terklasifikasi (Tanpa Kategori)</td>
                            <td class="border border-gray-300 p-2 text-center font-bold text-red-600">{{ $uncategorizedCount }}</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-200 font-bold">
                            <td colspan="3" class="border border-gray-300 p-2 text-right">TOTAL KOLEKSI JUDUL:</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $categories->sum('books_count') + $uncategorizedCount }}</td>
                        </tr>
                    </tfoot>
                </table>

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