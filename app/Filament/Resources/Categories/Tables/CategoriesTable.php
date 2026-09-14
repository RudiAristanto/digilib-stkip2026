<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([

                // TextColumn::make('sort_order')
                //     ->label('#')
                //     ->sortable()
                //     ->alignCenter(),

                TextColumn::make('nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->copyable()
                    ->searchable()
                    ->badge()
                    ->color('gray'),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('deleted_at')
                ->label('Dihapus')
                ->since()
                ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([
                TrashedFilter::make(),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}