<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use App\Models\Document;
use App\Models\Download;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Total Dokumen',
                Document::count()
            )
                ->description('Seluruh dokumen repository')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')

                ->chart([
                    7,
                    12,
                    9,
                    15,
                    18,
                    22,
                    30
                ]),

            Stat::make(
                'Total Penulis',
                Author::count()
            )
                ->description('Mahasiswa & Dosen')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')

                ->chart([
                    2,
                    5,
                    7,
                    9,
                    12,
                    15,
                    18
                ]),

            Stat::make(
                'Total Anggota',
                User::count()
            )
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning')

                ->chart([
                    5,
                    8,
                    10,
                    15,
                    17,
                    20,
                    25
                ]),

            Stat::make(
                'Total Download',
                Download::count()
            )
                ->description('Total unduhan dokumen')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('danger')

                ->chart([
                    10,
                    15,
                    30,
                    45,
                    60,
                    80,
                    120
                ]),

        ];
    }
}