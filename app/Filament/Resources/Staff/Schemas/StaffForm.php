<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil staff')
                    ->schema([
                        TextInput::make('name')->label('Nama lengkap')->required()->maxLength(255),
                        TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true),
                        TextInput::make('position')->label('Jabatan / posisi')->required(),
                        Select::make('category')->label('Kategori')->options(['Akademik' => 'Akademik', 'Administrasi' => 'Administrasi'])->default('Akademik')->required()->native(false),
                        FileUpload::make('photo')->label('Foto')->image()->disk('public')->directory('staff')->visibility('public'),
                        Textarea::make('education')->label('Pendidikan')->rows(3),
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('phone')->label('Telepon'),
                        TextInput::make('linkedin')->label('LinkedIn')->url(),
                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_active')->label('Tampilkan')->default(true),
                    ])->columns(2),
                Section::make('Biografi')
                    ->schema([RichEditor::make('bio')->label('Biografi')->columnSpanFull()]),
            ]);
    }
}
