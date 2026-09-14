<?php

namespace App\Filament\Resources\Documents\Tables;
use App\Notifications\DocumentStatusUpdated;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Filters\TrashedFilter;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('cover')
                ->label('Cover')
                ->disk('public')
                
                ->defaultImageUrl(asset('images/no-cover.png'))
                ->circular(),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->description(fn ($record) => $record->author?->nama_penulis),

                TextColumn::make('category.nama_kategori')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('tahun_terbit')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'pending',
                        'success' => 'published',
                        'danger' => 'rejected',
                    ])
                    ->icons([
                        'heroicon-o-pencil-square' => 'draft',
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-check-circle' => 'published',
                        'heroicon-o-x-circle' => 'rejected',
                    ]),

                TextColumn::make('access_type')
                    ->badge()
                    ->colors([
                        'success' => 'public',
                        'danger' => 'private',
                    ]),

                TextColumn::make('jumlah_download')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('jumlah_view')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                
                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('category')
                ->relationship('category', 'nama_kategori'),

                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'pending' => 'Pending',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                    ]),

                SelectFilter::make('access_type')
                    ->options([
                        'public' => 'Public',
                        'private' => 'Private',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),

                Action::make('approve')
                ->label('Approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn ($record) => $record->status !== 'published')
                ->action(function ($record) {

                    $record->update([
                        'status' => 'published',
                        'review_note' => null,
                    ]);
                    $record->user?->notify(
                    new DocumentStatusUpdated($record)
                    );
                }),

                Action::make('reject')
                ->label('Reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->form([
                    Textarea::make('review_note')
                        ->label('Alasan Penolakan')
                        ->required(),
                ])->action(function ($record, array $data) {
                    $record->update([
                        'status' => 'rejected',
                        'review_note' => $data['review_note'],
                    ]);
                    $record->user?->notify(
                        new DocumentStatusUpdated($record)
                    );
                }),

                Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) =>
                    route('pdf.viewer', $record)
                )
                ->openUrlInNewTab()

    ->openUrlInNewTab(),
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
