<?php

namespace App\Filament\Resources\UserGuides\Pages;

use App\Filament\Resources\UserGuides\UserGuideResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserGuide extends CreateRecord
{
    protected static string $resource = UserGuideResource::class;
}
