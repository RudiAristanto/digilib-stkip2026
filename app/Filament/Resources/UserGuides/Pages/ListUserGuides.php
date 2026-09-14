<?php

namespace App\Filament\Resources\UserGuides\Pages;

use App\Filament\Resources\UserGuides\UserGuideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserGuides extends ListRecords
{
    protected static string $resource = UserGuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
