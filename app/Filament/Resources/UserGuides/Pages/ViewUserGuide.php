<?php

namespace App\Filament\Resources\UserGuides\Pages;

use App\Filament\Resources\UserGuides\UserGuideResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserGuide extends ViewRecord
{
    protected static string $resource = UserGuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
