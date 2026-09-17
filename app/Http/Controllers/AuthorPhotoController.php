<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthorPhotoService;

class AuthorPhotoController extends Controller
{
     public function update(
        Request $request,
        AuthorPhotoService $photoService
    ) {
        $request->validate([
            'foto' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WebP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil Author dari User Login
        |--------------------------------------------------------------------------
        */

        $author = $request->user()->author;

        if (! $author) {
            return back()->with(
                'error',
                'Akun Anda belum terhubung dengan data penulis.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload + Resize + WebP
        |--------------------------------------------------------------------------
        */

        $path = $photoService->upload(
            $author,
            $request->file('foto')
        );

        /*
        |--------------------------------------------------------------------------
        | Simpan path ke database
        |--------------------------------------------------------------------------
        */

        $author->update([
            'foto' => $path,
        ]);

        return back()->with(
            'success',
            'Foto profil berhasil diperbarui.'
        );
    }
}
