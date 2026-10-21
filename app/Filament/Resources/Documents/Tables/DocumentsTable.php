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

                TextColumn::make('studyProgram.nama_prodi')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->placeholder('-'),

                TextColumn::make('tahun_terbit')
                    ->sortable(),

                TextColumn::make('total_pages')
                    ->label('Halaman')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->suffix(' Hal')
                    ->placeholder('-'),

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
                
                SelectFilter::make('study_program_id')
                    ->label('Program Studi')
                    ->relationship(
                        'studyProgram',
                        'nama_prodi'
                    )
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),

                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Publikasikan Dokumen')
                    ->modalDescription('Apakah Anda yakin ingin mempublikasikan dokumen ini? Dokumen yang dipublikasikan akan dapat diakses oleh pengguna.')
                    ->visible(fn ($record) => $record->status !== 'published')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'published',
                            'review_note' => null,
                        ]);

                        $record->user?->notify(
                            new DocumentStatusUpdated($record)
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Dokumen berhasil dipublikasikan')
                            ->success()
                            ->send();
                    }),

                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Tarik Publikasi (Unpublish)')
                    ->modalDescription('Apakah Anda yakin ingin menarik dokumen ini dari publikasi? Dokumen akan berstatus draft/pending sehingga tidak muncul di halaman publik.')
                    ->visible(fn ($record) => $record->status === 'published')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'draft',
                        ]);

                        $record->user?->notify(
                            new DocumentStatusUpdated($record)
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Publikasi dokumen berhasil ditarik (Unpublished)')
                            ->warning()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
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

                        \Filament\Notifications\Notification::make()
                            ->title('Dokumen ditolak')
                            ->danger()
                            ->send();
                    }),

                Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) =>
                    route('pdf.viewer', $record)
                )
                ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    \Filament\Actions\BulkAction::make('publishBulk')
                        ->label('Publish Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => 'published',
                                    'review_note' => null,
                                ]);
                            });

                            \Filament\Notifications\Notification::make()
                                ->title('Dokumen terpilih berhasil dipublikasikan')
                                ->success()
                                ->send();
                        }),

                    \Filament\Actions\BulkAction::make('unpublishBulk')
                        ->label('Unpublish Terpilih')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => 'draft',
                                ]);
                            });

                            \Filament\Notifications\Notification::make()
                                ->title('Publikasi dokumen terpilih berhasil ditarik')
                                ->warning()
                                ->send();
                        }),

                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
