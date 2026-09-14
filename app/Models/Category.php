<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (blank($category->slug)) {
                $category->slug = Str::slug($category->nama_kategori);
            }
        });

        static::updating(function (Category $category) {
            if ($category->isDirty('nama_kategori')) {
                $category->slug = Str::slug($category->nama_kategori);
            }
        });
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
