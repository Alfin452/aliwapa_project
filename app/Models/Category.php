<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'kode_ddc'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
