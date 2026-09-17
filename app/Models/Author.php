<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;
    
     protected $fillable = [
        'nama_penulis',
        'user_id',
        'nim_nidn',
        'email',
        'status',
        'foto',
    ];

    // protected $casts = [
    //     'status' => \App\Enums\AuthorStatus::class,
    // ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return asset('storage/' . $this->foto)
            . '?v=' . $this->updated_at?->timestamp;
    }
}
