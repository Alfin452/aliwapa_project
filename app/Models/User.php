<?php

namespace App\Models;

// use ... (biarkan bawaan)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ... $fillable, $hidden, $casts biarkan bawaan saja ...
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' ada disini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- TAMBAHAN KITA ---

    // Relasi: 1 User bisa menginput BANYAK Buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
