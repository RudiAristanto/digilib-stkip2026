<?php

namespace App\Filament\Resources\StudyPrograms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StudyProgramForm
{
     public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Program Studi')
                    ->description('Kelola data program studi yang tersedia.')
                    ->schema([
                        TextInput::make('nama_prodi')
                            ->label('Nama Program Studi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn ($state, callable $set) =>
                                    $set('slug', Str::slug($state))
                            ),

                        TextInput::make('kode_prodi')
                            ->label('Kode Program Studi')
                            ->placeholder('Contoh: PBSI')
                            ->maxLength(50),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }
}
