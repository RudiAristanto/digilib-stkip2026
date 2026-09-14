<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestDocuments extends BaseWidget
{
    protected static ?string $heading = 'Dokumen Terbaru';

    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Document::query()
                    ->with(['author', 'category'])
                    ->latest()
                    ->limit(5)
            )

            ->columns([

                Tables\Columns\ImageColumn::make('cover')
                    ->disk('public')
                    ->label('')
                    ->square()
                    ->size(50)
                    ->defaultImageUrl(asset('images/no-cover.png')),

                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(40)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('author.nama_penulis')
                    ->label('Penulis')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('category.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'published',
                        'warning' => 'pending',
                        'danger' => 'rejected',
                        'gray' => 'draft',
                    ]),

                Tables\Columns\TextColumn::make('tahun_terbit')
                    ->alignCenter(),

            ])

            ->paginated(false);
    }
}