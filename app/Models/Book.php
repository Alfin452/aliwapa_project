<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini di atas

class Book extends Model
{
    use SoftDeletes; // Aktifkan fitur soft delete

    protected $fillable = [
        'user_id',
        'shelf_id',
        'category_id',
        'nomor_induk_buku',
        'nomor_barcode',
        'judul',
        'pengarang',
        'tempat_terbit',
        'penerbit',
        'tahun_terbit',
        'qty_inventaris',
        'qty_opac',
        'qty_rak',
        'keterangan',
    ];

    // Relasi ke User (Setiap buku milik 1 user penginput)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Rak
    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
