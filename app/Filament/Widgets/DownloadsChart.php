<?php

namespace App\Filament\Widgets;

use App\Models\Download;
use Filament\Widgets\ChartWidget;

class DownloadsChart extends ChartWidget
{
    protected ?string $heading = 'Download Dokumen';

    protected function getData(): array
    {
        $months = [];
        $totals = [];

        for ($i = 1; $i <= 12; $i++) {

            $months[] = date('M', mktime(0,0,0,$i,1));

            $totals[] = Download::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();

        }

        return [

            'datasets' => [
                [
                    'label' => 'Download',
                    'data' => $totals,
                ],
            ],

            'labels' => $months,

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}