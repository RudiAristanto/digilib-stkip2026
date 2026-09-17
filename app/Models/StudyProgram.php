<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyProgram extends Model
{
     protected $fillable = [
        'nama_prodi',
        'kode_prodi',
        'slug',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
