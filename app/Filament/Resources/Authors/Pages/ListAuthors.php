<?php

namespace App\Filament\Resources\Authors\Pages;

use App\Filament\Resources\Authors\AuthorResource;
use App\Imports\AuthorsImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class ListAuthors extends ListRecords
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('downloadTemplate')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->url(asset('templates/template_import_penulis.xlsx'))
                ->openUrlInNewTab(false),

            Action::make('importExcel')
                ->label('Import Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')

                ->schema([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->required()
                        ->disk('local')
                        ->directory('imports/authors')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ]),
                ])

                ->modalHeading('Import Data Penulis')
                ->modalDescription(
                    'Upload file Excel dengan format .xlsx atau .xls.'
                )
                ->modalSubmitActionLabel('Import')

                ->action(function (array $data): void {

                    try {

                        /*
                        |--------------------------------------------------------------------------
                        | IMPORT LANGSUNG DARI STORAGE DISK
                        |--------------------------------------------------------------------------
                        */

                        Excel::import(
                            new AuthorsImport(),
                            $data['file'],
                            'local'
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | HAPUS FILE IMPORT SETELAH SELESAI
                        |--------------------------------------------------------------------------
                        */

                        if (Storage::disk('local')->exists($data['file'])) {
                            Storage::disk('local')->delete($data['file']);
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | NOTIFIKASI
                        |--------------------------------------------------------------------------
                        */

                        Notification::make()
                            ->title('Import berhasil')
                            ->body(
                                'Data penulis dan akun user berhasil ditambahkan.'
                            )
                            ->success()
                            ->send();

                    } catch (ValidationException $e) {

                        $failures = $e->failures();

                        $messages = [];

                        foreach ($failures as $failure) {

                            $messages[] =
                                'Baris ' . $failure->row()
                                . ': '
                                . implode(', ', $failure->errors());
                        }

                        Notification::make()
                            ->title('Import gagal')
                            ->body(
                                implode("\n", array_slice($messages, 0, 5))
                            )
                            ->danger()
                            ->persistent()
                            ->send();

                    } catch (Throwable $e) {

                        Notification::make()
                            ->title('Import gagal')
                            ->body($e->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),

            CreateAction::make()
                ->label('Tambah Penulis'),
        ];
    }
}