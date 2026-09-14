<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                ComponentsSection::make('Informasi Kategori')
                    ->schema([

                        ComponentsGrid::make(2)
                            ->schema([

                                TextEntry::make('nama_kategori')
                                    ->label('Nama Kategori')
                                    ->weight('bold'),

                                TextEntry::make('slug')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('icon')
                                    ->label('Icon')
                                    ->placeholder('-'),

                                TextEntry::make('sort_order')
                                    ->label('Urutan'),

                                IconEntry::make('is_active')
                                    ->label('Status')
                                    ->boolean(),

                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d M Y H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Diubah')
                                    ->dateTime('d M Y H:i'),

                            ])

                    ]),
                    ComponentsSection::make('Informasi Tambahan')
                    ->schema([
                        TextEntry::make('deskripsi')
                        ->label('Deskripsi'),
                    ])
            ]);
    }
}