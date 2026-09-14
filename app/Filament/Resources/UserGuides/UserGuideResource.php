<?php

namespace App\Filament\Resources\UserGuides;

use App\Filament\Resources\UserGuides\Pages\CreateUserGuide;
use App\Filament\Resources\UserGuides\Pages\EditUserGuide;
use App\Filament\Resources\UserGuides\Pages\ListUserGuides;
use App\Filament\Resources\UserGuides\Pages\ViewUserGuide;
use App\Filament\Resources\UserGuides\Schemas\UserGuideForm;
use App\Filament\Resources\UserGuides\Schemas\UserGuideInfolist;
use App\Filament\Resources\UserGuides\Tables\UserGuidesTable;
use App\Models\UserGuide;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserGuideResource extends Resource
{
    protected static ?string $model = UserGuide::class;

    protected static ?string $navigationLabel = 'Panduan';

    protected static ?string $pluralModelLabel = 'Panduan';

    protected static ?string $modelLabel = 'Panduan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return UserGuideForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserGuideInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserGuidesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserGuides::route('/'),
            'create' => CreateUserGuide::route('/create'),
            'view' => ViewUserGuide::route('/{record}'),
            'edit' => EditUserGuide::route('/{record}/edit'),
        ];
    }
}
