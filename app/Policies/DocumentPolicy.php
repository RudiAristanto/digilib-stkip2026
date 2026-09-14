<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Admin boleh semua aksi pada Document.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    /**
     * User biasa boleh melihat daftar dokumen miliknya
     * melalui logic aplikasi user.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * User hanya boleh melihat dokumen miliknya sendiri.
     */
    public function view(User $user, Document $document): bool
    {
        return $document->user_id === $user->id;
    }

    /**
     * User boleh membuat dokumen.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * User hanya boleh edit dokumen miliknya
     * yang masih pending atau rejected.
     */
    public function update(User $user, Document $document): bool
    {
        return $document->user_id === $user->id
            && in_array($document->status, [
                'pending',
                'rejected',
            ], true);
    }

    /**
     * Untuk sementara user biasa tidak boleh hapus.
     */
    public function delete(User $user, Document $document): bool
    {
        return false;
    }

    public function restore(User $user, Document $document): bool
    {
        return false;
    }

    public function forceDelete(User $user, Document $document): bool
    {
        return false;
    }
}