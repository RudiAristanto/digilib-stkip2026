<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AuthorPhotoService
{
    public function upload(Author $author, UploadedFile $file): string
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file->getRealPath());

        /*
        |--------------------------------------------------------------------------
        | Crop + Resize
        |--------------------------------------------------------------------------
        |
        | cover(300, 300) akan mempertahankan rasio gambar kemudian
        | melakukan crop ke ukuran persegi 300 x 300.
        |
        */

        $image->cover(300, 300);

        /*
        |--------------------------------------------------------------------------
        | Convert WebP
        |--------------------------------------------------------------------------
        */

        $encoded = $image->toWebp(80);

        /*
        |--------------------------------------------------------------------------
        | Nama File
        |--------------------------------------------------------------------------
        */

        $filename = 'author-' . $author->id . '.webp';

        $path = 'authors/' . $filename;

        /*
        |--------------------------------------------------------------------------
        | Simpan hasil akhir
        |--------------------------------------------------------------------------
        */

        Storage::disk('public')->put(
            $path,
            (string) $encoded
        );

        return $path;
    }

    public function delete(Author $author): void
    {
        if (
            $author->foto &&
            Storage::disk('public')->exists($author->foto)
        ) {
            Storage::disk('public')->delete($author->foto);
        }
    }
}