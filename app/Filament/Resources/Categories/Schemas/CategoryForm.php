<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section as ComponentsSection;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->components([

                ComponentsSection::make('Informasi Kategori')
                    ->schema([

                        TextInput::make('nama_kategori')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                ComponentsSection::make('Pengaturan')
                    ->schema([

                        TextInput::make('icon')
                            ->helperText('Contoh: heroicon-o-book-open'),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->default(true)

                    ])
                    ->columns(3),

            ]);
    }
}
