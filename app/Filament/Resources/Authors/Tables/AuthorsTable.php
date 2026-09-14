<?php

namespace App\Filament\Resources\Authors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class AuthorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('nama_penulis')
            ->columns([

                TextColumn::make('nama_penulis')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nim_nidn')
                    ->label('NIM / NIDN')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Dosen',
                        'info' => 'Mahasiswa',
                    ]),

                TextColumn::make('documents_count')
                    ->label('Jumlah Dokumen')
                    ->counts('documents')
                    ->badge(),
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