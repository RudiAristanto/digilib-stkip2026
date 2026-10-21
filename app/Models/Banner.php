<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'judul',
        'judul_sorot',
        'deskripsi',
        'gambar',
        'tombol_teks',
        'tombol_url',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function getGambarUrlAttribute(): string
    {
        if (blank($this->gambar)) {
            return asset('images/hero-library.png');
        }

        if (str_starts_with($this->gambar, 'http') || str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }

        if (Storage::disk('public')->exists($this->gambar)) {
            return Storage::disk('public')->url($this->gambar);
        }

        return asset('images/hero-library.png');
    }
}
