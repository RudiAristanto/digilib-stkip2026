<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use Filament\Widgets\ChartWidget;

class DocumentsChart extends ChartWidget
{
    protected ?string $heading = 'Upload Dokumen per Bulan';

    protected function getData(): array
    {
        $months = [];
        $totals = [];

        for ($i = 1; $i <= 12; $i++) {

            $months[] = date('M', mktime(0,0,0,$i,1));

            $totals[] = Document::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }

        return [

            'datasets' => [
                [
                    'label' => 'Upload Dokumen',
                    'data' => $totals,
                ],
            ],

            'labels' => $months,

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}