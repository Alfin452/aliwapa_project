<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penghapusan</h2>
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
                <button onclick="window.print()" class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800">Cetak Berita Acara</button>
            </div>

            <div id="print-area" class="bg-white p-8 rounded-lg shadow">
                <div class="text-center border-b-2 border-black pb-4 mb-6">
                    <h1 class="text-2xl font-bold uppercase">Perpustakaan Digital</h1>
                    <h2 class="text-lg font-semibold uppercase">Laporan Penghapusan Inventaris (Berita Acara)</h2>
                    <p class="text-sm text-gray-500">Status Data: Dihapus dari sistem (Trash)</p>
                </div>

                <table class="w-full text-left border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-red-50 text-center font-bold">
                            <th class="border border-gray-300 p-2 w-10">No</th>
                            <th class="border border-gray-300 p-2 w-32">Tgl Dihapus</th>
                            <th class="border border-gray-300 p-2 w-32">No. Induk</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2 w-48">Pengarang</th>
                            <th class="border border-gray-300 p-2 w-48">Keterangan / Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedBooks as $index => $book)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $book->deleted_at->format('d/m/Y') }}</td>
                            <td class="border border-gray-300 p-2 font-bold">{{ $book->no_induk_buku }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->judul }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->pengarang }}</td>
                            {{-- Gunakan keterangan buku atau default --}}
                            <td class="border border-gray-300 p-2 text-red-600 italic">
                                {{ $book->keterangan ? Str::limit($book->keterangan, 50) : 'Rusak / Hilang (Dihapus Admin)' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="border border-gray-300 p-4 text-center">Tidak ada data penghapusan buku.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-8 flex justify-between px-8">
                    <div class="text-center">
                        <p class="mb-16">Petugas Inventaris</p>
                        <p class="font-bold underline">..............................</p>
                    </div>
                    <div class="text-center">
                        <p class="mb-16">Kepala Perpustakaan</p>
                        <p class="font-bold underline">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>