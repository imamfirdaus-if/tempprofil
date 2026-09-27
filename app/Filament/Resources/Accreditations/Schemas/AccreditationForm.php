<?php

namespace App\Filament\Resources\Accreditations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccreditationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Akreditasi')
                    ->schema([
                        TextInput::make('program_name')->label('Nama program studi')->required()->maxLength(255),
                        TextInput::make('degree')->label('Jenjang')->placeholder('S1 / S2 / S3'),
                        TextInput::make('level')->label('Level akreditasi')->placeholder('Unggul'),
                        TextInput::make('status')->label('Status')->default('Unggul')->required(),
                        TextInput::make('score')->label('Nilai / peringkat'),
                        TextInput::make('decree_number')->label('Nomor SK'),
                        TextInput::make('valid_until')->label('Berlaku sampai'),
                        FileUpload::make('logo')->label('Logo lembaga')->image()->disk('public')->directory('accreditations')->visibility('public'),
                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_active')->label('Tampilkan')->default(true),
                    ])->columns(2),
            ]);
    }
}
