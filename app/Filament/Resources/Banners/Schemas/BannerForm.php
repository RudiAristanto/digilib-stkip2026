<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Banner / Slider')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('badge')
                                    ->label('Teks Badge / Label Kecil')
                                    ->placeholder('Contoh: DIGITAL REPOSITORY STKIP')
                                    ->default('DIGITAL REPOSITORY STKIP')
                                    ->maxLength(100),

                                TextInput::make('urutan')
                                    ->label('Urutan Tampil (Slide)')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                            ]),

                        TextInput::make('judul')
                            ->label('Teks Judul Utama')
                            ->placeholder('Contoh: Temukan Ribuan')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('judul_sorot')
                            ->label('Teks Judul Sorot (Berwarna Kuning/Emas)')
                            ->placeholder('Contoh: Karya Ilmiah')
                            ->helperText('Teks ini akan diberi sorotan aksen warna agar lebih menarik.')
                            ->maxLength(255),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi / Sub-judul')
                            ->placeholder('Akses mudah ke skripsi, jurnal, tugas akhir, dan publikasi penelitian sivitas akademika STKIP...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('tombol_teks')
                                    ->label('Teks Tombol Aksi (Opsional)')
                                    ->placeholder('Contoh: Jelajahi Koleksi'),

                                TextInput::make('tombol_url')
                                    ->label('URL Tombol Aksi (Opsional)')
                                    ->placeholder('Contoh: /documents'),
                            ]),

                        FileUpload::make('gambar')
                            ->label('Gambar / Foto Banner')
                            ->image()
                            ->disk('public')
                            ->directory('banners')
                            ->imageResizeMode('cover')
                            ->maxSize(4096)
                            ->helperText('Format JPG, PNG, atau WEBP. Disarankan gambar mahasiswa/kampus berresolusi jernih dengan rasio landscape atau foto transparan.')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Aktifkan Slide Banner')
                            ->helperText('Hanya banner aktif yang akan muncul di slider halaman depan.')
                            ->default(true),
                    ]),
            ]);
    }
}
