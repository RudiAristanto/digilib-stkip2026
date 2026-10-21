<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use App\Notifications\DocumentStatusUpdated;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewDocument extends ViewRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('publish')
                ->label('Publish')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Publikasikan Dokumen')
                ->modalDescription('Apakah Anda yakin ingin mempublikasikan dokumen ini?')
                ->visible(fn () => $this->record->status !== 'published')
                ->action(function () {
                    $this->record->update([
                        'status' => 'published',
                        'review_note' => null,
                    ]);

                    $this->record->user?->notify(
                        new DocumentStatusUpdated($this->record)
                    );

                    Notification::make()
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
                ->modalDescription('Apakah Anda yakin ingin menarik dokumen ini dari status terbit?')
                ->visible(fn () => $this->record->status === 'published')
                ->action(function () {
                    $this->record->update([
                        'status' => 'draft',
                    ]);

                    $this->record->user?->notify(
                        new DocumentStatusUpdated($this->record)
                    );

                    Notification::make()
                        ->title('Publikasi dokumen berhasil ditarik')
                        ->warning()
                        ->send();
                }),

            EditAction::make(),
        ];
    }
}
