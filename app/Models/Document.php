<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    
protected $fillable = [

        'category_id',

        'author_id',

        'user_id',

        'judul',

        'slug',

        'abstrak',

        'kata_kunci',

        'tahun_terbit',

        'file_pdf',

        'cover',

        'file_size',

        'total_pages',

        'bahasa',

        'jumlah_download',

        'jumlah_view',

        'access_type',

        'status',

        'review_note',

        'study_program_id'

    ];

    protected static function booted(): void
    {
        static::saving(function ($document) {

            if (blank($document->slug)) {
                $document->slug = Str::slug($document->judul);
            }

            if (
                filled($document->file_pdf) &&
                Storage::disk('public')->exists($document->file_pdf)
            ) {
                $document->file_size = Storage::disk('public')->size($document->file_pdf);
            }

        });
    }

    protected function formattedFileSize(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->file_size
                ? number_format($this->file_size / 1024 / 1024, 2) . ' MB'
                : '-'
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

}
