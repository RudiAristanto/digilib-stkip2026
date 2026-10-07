<?php

namespace App\Filament\Resources\Authors\Pages;

use App\Filament\Resources\Authors\AuthorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EditAuthor extends EditRecord
{
    protected static string $resource = AuthorResource::class;

    protected ?string $accountPassword = null;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->accountPassword = !empty($data['password']) ? $data['password'] : null;

        unset($data['password'], $data['password_confirmation']);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $user = $record->user ?? User::where('email', $record->email)->first();

            if (! $user && ! empty($data['email'])) {
                $user = User::create([
                    'name' => $data['nama_penulis'],
                    'email' => $data['email'],
                    'password' => Hash::make($this->accountPassword ?? 'password123'),
                ]);
                $user->assignRole('user');
            } elseif ($user) {
                $userData = [
                    'name' => $data['nama_penulis'],
                    'email' => $data['email'],
                ];
                if ($this->accountPassword) {
                    $userData['password'] = Hash::make($this->accountPassword);
                }
                $user->update($userData);
            }

            if ($user && ! $record->user_id) {
                $data['user_id'] = $user->id;
            }

            $record->update($data);

            return $record;
        });
    }
}
