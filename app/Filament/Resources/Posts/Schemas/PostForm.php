<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi konten')
                    ->description('Konten unggulan di beranda dipilih otomatis dari konten terbaru yang dipublikasikan pada setiap jenis.')
                    ->schema([
                        Select::make('type')
                            ->label('Jenis')
                            ->options([
                                'news' => 'Berita',
                                'announcement' => 'Pengumuman',
                            ])
                            ->required()
                            ->native(false),
                        TextInput::make('title')->label('Judul')->required()->maxLength(255),
                        TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                        Textarea::make('excerpt')->label('Ringkasan')->rows(3)->maxLength(500),
                        FileUpload::make('image')->label('Gambar utama')->image()->disk('public')->directory('posts')->visibility('public'),
                        DateTimePicker::make('published_at')->label('Tanggal terbit')->native(false)->default(now()),
                        Toggle::make('is_published')->label('Publikasikan')->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Isi dan SEO')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Isi konten')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3'],
                                ['alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'],
                                ['undo', 'redo'],
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('content/posts')
                            ->fileAttachmentsVisibility('public')
                            ->extraInputAttributes(['style' => 'min-height: 30rem'])
                            ->helperText('Tulis isi berita atau pengumuman dengan toolbar. Gunakan tombol lampiran untuk menyisipkan gambar.')
                            ->columnSpanFull(),
                        TextInput::make('meta_title')->label('Meta title')->maxLength(255),
                        Textarea::make('meta_description')->label('Meta description')->rows(2)->maxLength(160),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
