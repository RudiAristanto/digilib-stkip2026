<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class AuthorsImport implements
    OnEachRow,
    WithHeadingRow,
    WithValidation,
    WithMapping
{
    public function map($row): array
    {
        return [
            'nama_penulis' => isset($row['nama_penulis'])
                ? (string) $row['nama_penulis']
                : null,

            'nim_nidn' => isset($row['nim_nidn'])
                ? (string) $row['nim_nidn']
                : null,

            'email' => isset($row['email'])
                ? (string) $row['email']
                : null,

            'status' => isset($row['status'])
                ? (string) $row['status']
                : null,

            'password' => isset($row['password'])
                ? (string) $row['password']
                : null,
        ];
    }

    public function onRow(Row $row): void
    {
        $data = $this->map($row->toArray());

        DB::transaction(function () use ($data) {

            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['nama_penulis'],
                    'password' => Hash::make($data['password']),
                ]
            );

            if (! $user->hasRole('user')) {
                $user->assignRole('user');
            }

            Author::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'nama_penulis' => $data['nama_penulis'],
                    'nim_nidn' => $data['nim_nidn'],
                    'status' => $data['status'],
                ]
            );
        });
    }

    public function rules(): array
    {
        return [
            '*.nama_penulis' => [
                'required',
                'string',
                'max:255',
            ],

            '*.nim_nidn' => [
                'nullable',
            ],

            '*.email' => [
                'required',
                'email',
                'max:255',
            ],

            '*.status' => [
                'required',
                Rule::in([
                    'Mahasiswa',
                    'Dosen',
                ]),
            ],

            '*.password' => [
                'required',
                'min:8',
            ],
        ];
    }
}