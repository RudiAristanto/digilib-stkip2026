<?php

namespace App\Filament\Resources\Documents;

use App\Filament\Resources\Documents\Pages\CreateDocument;
use App\Filament\Resources\Documents\Pages\EditDocument;
use App\Filament\Resources\Documents\Pages\ListDocuments;
use App\Filament\Resources\Documents\Pages\ViewDocument;
use App\Filament\Resources\Documents\Schemas\DocumentForm;
use App\Filament\Resources\Documents\Schemas\DocumentInfolist;
use App\Filament\Resources\Documents\Tables\DocumentsTable;
use App\Models\Document;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Filters\TrashedFilter;

use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;

use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    
    protected static ?string $navigationLabel = 'Dokumen';

    protected static ?string $pluralModelLabel = 'Dokumen';

    protected static ?string $modelLabel = 'Dokumen';

    protected static string | UnitEnum | null $navigationGroup = 'Repository';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function form(Schema $schema): Schema
        {
            return DocumentForm::configure($schema);
        }

    public static function infolist(Schema $schema): Schema
        {
            return DocumentInfolist::configure($schema);
        }

    public static function table(Table $table): Table
        {
            return DocumentsTable::configure($table);
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
                'index' => ListDocuments::route('/'),
                'create' => CreateDocument::route('/create'),
                'view' => ViewDocument::route('/{record}'),
                'edit' => EditDocument::route('/{record}/edit'),
            ];
        }

    public static function getGloballySearchableAttributes(): array
        {
            return [
                'judul',
                'slug',
                'author.nama_penulis',
                'category.nama_kategori',
            ];
        }

    public static function getRecordActions(): array
        {
            return [

                Action::make('download')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => asset('storage/'.$record->file_pdf))
                    ->openUrlInNewTab(),

            ];
        }

    public static function getNavigationBadge(): ?string
        {
            return (string) static::getModel()::where('status', 'pending')->count();
        }

    public static function getNavigationBadgeColor(): ?string
        {
            return 'warning';
        }

    public static function getEloquentQuery(): Builder
        {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }
}
