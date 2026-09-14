<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use App\Filament\Infolists\Components\PdfPreviewEntry;

class DocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | INFORMASI DOKUMEN
                |--------------------------------------------------------------------------
                */

                ComponentsSection::make('Informasi Dokumen')
                    ->icon('heroicon-o-document-text')
                    ->schema([

                        ComponentsGrid::make(3)
                            ->schema([

                                ImageEntry::make('cover')
                                    ->label('Cover')
                                    ->disk('public')
                                    ->imageHeight(150)
                                    ->defaultImageUrl(asset('images/no-cover.png'))
                                    ->columnSpan(1),

                                ComponentsGrid::make(2)
                                    ->schema([

                                        TextEntry::make('judul')
                                            ->label('Judul')
                                            ->weight('bold'),
                                            // ->size(TextEntry\TextEntrySize::Large),

                                        TextEntry::make('slug')
                                            ->copyable(),

                                        TextEntry::make('category.nama_kategori')
                                            ->label('Kategori')
                                            ->badge()
                                            ->color('primary'),

                                        TextEntry::make('author.nama_penulis')
                                            ->label('Penulis')
                                            ->badge()
                                            ->color('success'),

                                        TextEntry::make('user.name')
                                            ->label('Uploader')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('tahun_terbit')
                                            ->badge(),

                                    ])
                                    ->columnSpan(2),

                            ]),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | DESKRIPSI
                |--------------------------------------------------------------------------
                */

                ComponentsSection::make('Deskripsi')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([

                        TextEntry::make('kata_kunci')
                            ->label('Kata Kunci')
                            ->badge()
                            ->separator(','),

                        TextEntry::make('abstrak')
                            ->label('Abstrak')
                            ->html()
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | FILE
                |--------------------------------------------------------------------------
                */

                ComponentsSection::make('Informasi File')
                    ->icon('heroicon-o-folder')
                    ->schema([

                        ComponentsGrid::make(3)
                            ->schema([

                                TextEntry::make('formatted_file_size')
                                    ->label('Ukuran File')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('total_pages')
                                    ->label('Jumlah Halaman')
                                    ->suffix(' Halaman')
                                    ->placeholder('-'),

                                TextEntry::make('bahasa')
                                    ->badge()
                                    ->color('info'),

                            ]),

                        TextEntry::make('file_pdf')
                            ->label('Lokasi File')
                            ->copyable()
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | STATISTIK
                |--------------------------------------------------------------------------
                */

                ComponentsSection::make('Statistik')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([

                        ComponentsGrid::make(4)
                            ->schema([

                                TextEntry::make('jumlah_download')
                                    ->label('Download')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('jumlah_view')
                                    ->label('View')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('access_type')
                                    ->label('Hak Akses')
                                    ->badge()
                                    ->color(fn ($state) => $state === 'public'
                                        ? 'success'
                                        : 'danger'),

                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn ($state) => match ($state) {
                                        'published' => 'success',
                                        'pending' => 'warning',
                                        'draft' => 'gray',
                                        'rejected' => 'danger',
                                        default => 'gray',
                                    }),

                            ])

                    ]),

                /*
                |--------------------------------------------------------------------------
                | AUDIT
                |--------------------------------------------------------------------------
                */
                ComponentsSection::make('Preview Dokumen')
                    ->icon('heroicon-o-document')
                    ->collapsed()
                    ->schema([

                        PdfPreviewEntry::make('preview'),

                    ]),

                ComponentsSection::make('Riwayat')
                    ->icon('heroicon-o-clock')
                    ->collapsed()
                    ->schema([

                        ComponentsGrid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('d F Y H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diubah')
                                    ->dateTime('d F Y H:i'),

                            ])

                    ]),

            ]);
    }
}