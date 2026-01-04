<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cover',
        'user_id',
        'category_id',
        'shelf_id',
        'no_induk_buku',
        'no_barcode',
        'judul',
        'pengarang',
        'tempat_terbit',
        'penerbit',
        'tahun_terbit',
        'jml_inventaris',
        'jml_opac',
        'jml_rak',
        'keterangan',
    ];

    // Relasi: Buku milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Buku milik Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Buku milik Shelf
    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
