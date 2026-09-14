<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularDocuments extends BaseWidget
{
    protected static ?string $heading = 'Dokumen Terpopuler';

    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Document::query()
                    ->with(['author'])
                    ->orderByDesc('jumlah_download')
                    ->limit(5)
            )

            ->columns([

                Tables\Columns\TextColumn::make('judul')
                    ->limit(45)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('author.nama_penulis')
                    ->label('Penulis'),

                Tables\Columns\TextColumn::make('jumlah_download')
                    ->label('Download')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('jumlah_view')
                    ->label('View')
                    ->badge()
                    ->color('info'),

            ])

            ->paginated(false);
    }
}