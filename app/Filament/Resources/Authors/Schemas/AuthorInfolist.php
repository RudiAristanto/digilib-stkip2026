<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class AuthorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                ComponentsSection::make('Informasi Penulis')
                    ->icon('heroicon-o-user')
                    ->schema([

                        ComponentsGrid::make(2)
                            ->schema([

                                TextEntry::make('nama_penulis')
                                    ->label('Nama Penulis')
                                    ->weight('bold'),
                                    // ->size(TextEntry\TextEntrySize::Large),

                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'Dosen' => 'success',
                                        'Mahasiswa' => 'info',
                                        default => 'gray',
                                    }),

                                TextEntry::make('nim_nidn')
                                    ->label('NIM / NIDN')
                                    ->placeholder('-'),

                                TextEntry::make('email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable()
                                    ->placeholder('-'),

                            ])

                    ]),

                ComponentsSection::make('Statistik')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([

                        ComponentsGrid::make(3)
                            ->schema([

                                TextEntry::make('documents_count')
                                    ->label('Jumlah Dokumen')
                                    ->state(fn ($record) => $record->documents()->count())
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d M Y H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Diubah')
                                    ->dateTime('d M Y H:i'),

                            ])

                    ])

            ]);
    }
}