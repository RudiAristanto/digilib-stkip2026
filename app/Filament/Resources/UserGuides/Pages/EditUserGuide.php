<?php

namespace App\Filament\Resources\UserGuides\Pages;

use App\Filament\Resources\UserGuides\UserGuideResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUserGuide extends EditRecord
{
    protected static string $resource = UserGuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
