<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;
    
     protected $fillable = [
        'nama_penulis',
        'nim_nidn',
        'email',
        'status',
    ];

    // protected $casts = [
    //     'status' => \App\Enums\AuthorStatus::class,
    // ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
