<?php

namespace App\Filament\Resources\Documents\Schemas;

// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Schema;
use App\Models\Author;
use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        // return $schema
        //     ->components([
        //         Select::make('category_id')
        //             ->relationship('category', 'id')
        //             ->required(),
        //         Select::make('author_id')
        //             ->relationship('author', 'id')
        //             ->required(),
        //         Select::make('user_id')
        //             ->relationship('user', 'name')
        //             ->required(),
        //         TextInput::make('judul')
        //             ->required(),
        //         TextInput::make('slug')
        //             ->required(),
        //         Textarea::make('abstrak')
        //             ->required()
        //             ->columnSpanFull(),
        //         Textarea::make('kata_kunci')
        //             ->required()
        //             ->columnSpanFull(),
        //         TextInput::make('tahun_terbit')
        //             ->required(),
        //         TextInput::make('file_pdf')
        //             ->required(),
        //         TextInput::make('cover'),
        //         TextInput::make('file_size')
        //             ->numeric(),
        //         TextInput::make('total_pages')
        //             ->numeric(),
        //         TextInput::make('bahasa')
        //             ->required()
        //             ->default('Indonesia'),
        //         TextInput::make('jumlah_download')
        //             ->required()
        //             ->numeric()
        //             ->default(0),
        //         TextInput::make('jumlah_view')
        //             ->required()
        //             ->numeric()
        //             ->default(0),
        //         Select::make('access_type')
        //             ->options(['public' => 'Public', 'private' => 'Private'])
        //             ->default('public')
        //             ->required(),
        //         Select::make('status')
        //             ->options([
        //     'draft' => 'Draft',
        //     'pending' => 'Pending',
        //     'published' => 'Published',
        //     'rejected' => 'Rejected',
        // ])
        //             ->default('pending')
        //             ->required(),
        //     ]);
        return $schema

            ->components([

                ComponentsSection::make('Metadata Dokumen')

                    ->schema([

                        TextInput::make('judul')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set)
                                => $set('slug', Str::slug($state)))
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'nama_kategori')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('study_program_id')
                            ->label('Program Studi')
                            ->relationship(
                                name: 'studyProgram',
                                titleAttribute: 'nama_prodi'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('author_id')
                            ->label('Penulis')
                            ->relationship('author', 'nama_penulis')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('tahun_terbit')
                        ->label('Tahun Terbit')
                        ->options(
                            collect(range(date('Y'), 2000))
                                ->mapWithKeys(fn ($year) => [$year => $year])
                                ->toArray()
                        )
                        ->searchable()
                        ->required(),

                        TagsInput::make('kata_kunci')
                            ->separator(','),

                        RichEditor::make('abstrak')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'bulletList',
                                'orderedList',
                            ])
                            ->required(),
                        
                        Textarea::make('review_note')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn () => auth()->user()->hasRole('admin'))
                            ->helperText('Isi alasan apabila dokumen ditolak.'),

                    ])->columns(2),

                    ComponentsSection::make('File Dokumen')
                    ->schema([
                        
                        FileUpload::make('cover')
                        ->label('Cover Dokumen')
                        ->image()
                        ->disk('public')
                        ->directory('covers')
                        ->imageEditor()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('3:4')
                        ->imageResizeTargetWidth(600)
                        ->imageResizeTargetHeight(800)
                        ->downloadable()
                        ->openable()
                        ->maxSize(2048)
                        ->helperText('Format JPG, PNG atau WEBP. Maksimal 2 MB.')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file) => (string) \Illuminate\Support\Str::uuid()
                                . '.'
                                . $file->getClientOriginalExtension()
                        ),

                        FileUpload::make('file_pdf')
                        ->acceptedFileTypes([
                            'application/pdf',
                        ])
                        ->disk('public')
                        ->directory('documents')
                        ->downloadable()
                        ->openable()
                        ->previewable(false)
                        ->required()
                        ->maxSize(51200)
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file) => (string) \Illuminate\Support\Str::uuid() .
                                '.' .
                                $file->getClientOriginalExtension()
                        ),
                    ]),

            ]);
    }
}
