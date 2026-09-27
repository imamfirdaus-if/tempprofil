<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengaturan Halaman')
                    ->schema([
                        TextInput::make('title')->label('Judul')->required()->maxLength(255),
                        TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                        TextInput::make('nav_label')->label('Label menu')->maxLength(255),
                        Select::make('category')->label('Kategori')->options([
                            'profil' => 'Profil Jurusan',
                            'akademik' => 'Akademik',
                            'publikasi' => 'Publikasi',
                            'informasi' => 'Informasi',
                            'kontak' => 'Kontak',
                        ])->required()->native(false),
                        Textarea::make('excerpt')->label('Ringkasan')->rows(3)->maxLength(500),
                        FileUpload::make('featured_image')->label('Gambar halaman')->image()->disk('public')->directory('pages')->visibility('public'),
                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_published')->label('Publikasikan')->default(true),
                    ])->columns(2),
                Section::make('Isi & SEO')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Isi halaman')
                            ->extraInputAttributes(['style' => 'min-height: 32rem;'])
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'],
                                ['undo', 'redo'],
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('content/pages')
                            ->fileAttachmentsVisibility('public')
                            ->helperText('Edit konten halaman profil, akademik, informasi, publikasi, dan kontak. Gunakan tombol lampiran untuk menyisipkan gambar.')
                            ->columnSpanFull(),
                        TextInput::make('meta_title')->label('Meta title')->maxLength(255),
                        Textarea::make('meta_description')->label('Meta description')->rows(2)->maxLength(160),
                    ])->columns(2),
            ]);
    }
}
