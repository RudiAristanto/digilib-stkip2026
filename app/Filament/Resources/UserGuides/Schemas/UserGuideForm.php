<?php

namespace App\Filament\Resources\UserGuides\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class UserGuideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4),

                FileUpload::make('file')
                    ->label('File Petunjuk')
                    ->disk('public')
                    ->directory('user-guides')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->required(),

                Toggle::make('is_active')
                    ->label('Tampilkan di Homepage')
                    ->default(true),
            ]);
    }
}
