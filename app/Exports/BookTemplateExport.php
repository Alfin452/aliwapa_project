<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    public function array(): array
    {
        // Contoh Data Dummy (Agar user paham cara isinya)
        return [
            [
                'IND-2024-001',           // No Induk
                '9786022914',             // Barcode
                'Laskar Pelangi',         // Judul
                'Andrea Hirata',          // Pengarang
                'Yogyakarta',             // Tempat Terbit
                'Bentang Pustaka',        // Penerbit
                '2005',                   // Tahun
                '10',                     // Jml Inventaris
                '5',                      // Jml OPAC
                '5',                      // Jml Rak
                'Kondisi buku masih sangat bagus', // Keterangan
                '800',                    // Kode Kategori (PENTING)
                'Rak A1'                  // Lokasi Rak (PENTING)
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Nomor Induk Buku',
            'Nomor Barcode',
            'Judul',
            'Pengarang',
            'Tempat Terbit',
            'Penerbit',
            'Tahun Terbit',
            'Jumlah Eksmplar di Inventaris Buku',
            'Jumlah Eksmplar di OPAC',
            'Jumlah Eksmplar di Rak',
            'Keterangan',
            'Kode Kategori', // Hapus tulisan (Wajib)
            'Lokasi Rak'     // Hapus tulisan (Wajib)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bikin Baris 1 (Header) jadi Tebal (Bold)
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
