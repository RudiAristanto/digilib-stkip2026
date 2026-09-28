<?php

namespace App\Filament\Resources\Authors\Pages;

use App\Filament\Resources\Authors\AuthorResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;

    protected ?string $accountPassword = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->accountPassword = $data['password'];

        unset($data['password'], $data['password_confirmation']);

        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['nama_penulis'],
                'email' => $data['email'],
                'password' => Hash::make($this->accountPassword),
            ]);

            $user->assignRole('user');

            $data['user_id'] = $user->id;

            return static::getModel()::create($data);
        });
    }
}
