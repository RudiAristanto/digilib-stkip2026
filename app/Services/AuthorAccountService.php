<?php

namespace App\Services;

use App\Models\Author;
use App\Models\User;

class AuthorAccountService
{
    public function connect(User $user): ?Author
    {
        // Sudah terhubung, tidak perlu melakukan apa-apa.
        if ($user->author) {
            return $user->author;
        }

        // Cari Author berdasarkan email.
        $author = Author::query()
            ->whereNull('user_id')
            ->where('email', $user->email)
            ->first();

        // Kalau ketemu, hubungkan.
        if ($author) {
            $author->update([
                'user_id' => $user->id,
            ]);

            return $author;
        }

        return null;
    }
}