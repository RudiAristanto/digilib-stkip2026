<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                ComponentsSection::make('Data Penulis')
                    ->schema([

                        TextInput::make('nama_penulis')
                            ->label('Nama Penulis')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('nim_nidn')
                            ->label('NIM / NIDN')
                            ->maxLength(50),

                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true),

                        Select::make('status')
                            ->options([
                                'Mahasiswa' => 'Mahasiswa',
                                'Dosen' => 'Dosen',
                            ])
                            ->required(),

                    ])
                    ->columns(2),

            ]);
    }
}